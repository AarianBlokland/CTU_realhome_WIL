<?php
session_start();
// Check if the agent is logged in
if (!isset($_SESSION['agent_id'])) {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit();
}

// Fetch agent information
$agent_id = $_SESSION['agent_id'];
$host = 'localhost';
$db = 'realhomeprop';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get agent details
$agentQuery = $conn->prepare("SELECT * FROM agents WHERE id = ?");
$agentQuery->bind_param("i", $agent_id);
$agentQuery->execute();
$agentResult = $agentQuery->get_result();
$agent = $agentResult->fetch_assoc();

// Get properties listed by the agent
$propertiesQuery = $conn->prepare("SELECT * FROM properties WHERE agent_id = ?");
$propertiesQuery->bind_param("i", $agent_id);
$propertiesQuery->execute();
$propertiesResult = $propertiesQuery->get_result();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $agent['name']; ?>'s Profile</title>
        <link rel="stylesheet" href="realhome.css">
        <style>
            .loginlink:link {
                font-size: 12px;
                text-decoration: none;
                color: rgb(59, 59, 59);
            }
            .loginlink:visited {
                color: rgb(59, 59, 59);
            }
            table, tr, td {
                width: 100%;
                padding-top: auto;
                padding-bottom: auto;
            }
        </style>
    </head>
    <body>
        <header>
            <h1><?php echo htmlspecialchars($agent['name']); ?>'s Profile</h1>
            <p><a href="logout.php">Logout</a></p>
        </header>

        <div class="agent-profile">
            <h2>Contact Information</h2>
            <p><b>Phone:</b> <?php echo htmlspecialchars($agent['phone']); ?></p>
            <p><b>Email:</b> <?php echo htmlspecialchars($agent['email']); ?></p>
            <p><b>Agency:</b> <?php echo htmlspecialchars($agent['agency']); ?></p>
            <p><b>Experience:</b> <?php echo htmlspecialchars($agent['experience']); ?> years</p>
            <p><b>Specialization:</b> <?php echo htmlspecialchars($agent['specialization']); ?></p>
            <p><b>License Number:</b> <?php echo htmlspecialchars($agent['license']); ?></p>
        
            <h2>About <?php echo htmlspecialchars($agent['name']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($agent['bio'])); ?></p>
        </div>

        <div class="contact-form">
            <h2>Contact <?php echo htmlspecialchars($agent['name']); ?></h2>
            <form method="POST" action="send_inquiry.php">
                <input type="hidden" name="agent_id" value="<?php echo $agent['id']; ?>">
                <label for="user_name">Your Name:</label>
                <input type="text" id="user_name" name="user_name" required>
            
                <label for="user_email">Your Email:</label>
                <input type="email" id="user_email" name="user_email" required>
            
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            
                <button type="submit">Send Inquiry</button>
            </form>
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $agent_id = $_POST['agent_id'];
                    $user_name = $_POST['user_name'];
                    $user_email = $_POST['user_email'];
                    $message = $_POST['message'];
                    $host = 'localhost';
                    $db = 'realhomeprop';
                    $user = 'root';
                    $pass = '';
                    $conn = new mysqli($host, $user, $pass, $db);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $stmt = $conn->prepare("INSERT INTO inquiries (agent_id, user_name, user_email, message) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("isss", $agent_id, $user_name, $user_email, $message);
                    if ($stmt->execute()) {
                        echo "Your message has been sent successfully!";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                    $conn->close();
                } else {
                    echo "Invalid request.";
                }
            ?>
        </div>
        <div class="agent-properties">
            <h2>Properties Listed by <?php echo htmlspecialchars($agent['name']); ?></h2>
            <?php if ($propertiesResult->num_rows > 0): ?>
                <ul>
                    <?php while ($property = $propertiesResult->fetch_assoc()): ?>
                        <li>
                            <h3><?php echo $property['bedrooms']; ?> Bedroom <?php echo ucfirst($property['property_type']); ?></h3>
                            <p><b>Price:</b> <?php echo $property['price']; ?> ZAR</p>
                            <p><b>Location:</b> <?php echo $property['address']; ?></p>
                            <a href="property_details.php?id=<?php echo $property['id']; ?>">View Details</a>
                        </li>
                    <?php endwhile; ?>
               </ul>
            <?php else: ?>
                <p>No properties listed by this agent.</p>
            <?php endif; ?>
        </div>
        <?php
            $agentQuery->close();
            $propertiesQuery->close();
            $conn->close();
        ?>
    </body>
</html>
