<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$host = 'localhost';
$db = 'realhomeprop';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="realhome.css">
    <title>User Profile</title>
    <style>
        .profile-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .profile-container h2 {
            color: #333;
        }
        .profile-container p {
            color: #666;
            font-size: 16px;
            margin: 5px 0;
        }
    </style>
</head>
<body>

<header class="mainheader">
    <h1 class="title">RealHome</h1>
</header>

<div class="profile-container">
    <h2>Welcome, <?php echo htmlspecialchars($user_data['name']); ?>!</h2>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user_data['email']); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlspecialchars($user_data['phone']); ?></p>
    <!-- Add more user data fields here as needed -->
</div>

<footer class="mainfooter">
    <p>&copy; 2024 City Technical University, Aarian. All rights reserved.</p>
</footer>

</body>
</html>
