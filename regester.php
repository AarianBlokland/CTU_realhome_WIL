<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="realhome.css">
        <style>
            body{
                font-size: larger;
                background-size: cover;
                background-attachment: fixed !important;
                background-image: url('bgimg.png'   ) !important;
                
            }
            button{
                background-color: #05f772;
                border: solid #05f772 5px;
                width: 130px;
                height: 30px;
            }
            button:hover {
                background-color: #04d865;
                border: solid #04d865 5px;
            }
        </style>
    </head>
    <body>
        <div class="loginwraper">
            <h1 style="color: #05f772;"><u>Register as Agent</u></h1>
            <p>To become a <i>RealHome</i> agent, please complete the form below.</p>
            <hr color="darkgray" size="2px" width="70%">
            <form method="post">
                <label for="name"><b>Name:</b></label><br>
                <input type="text" id="name" name="name" placeholder="Full Name*" required>
                <br>
                <label for="phone"><b>Work Number:</b></label><br>
                <input type="tel" id="phone" name="phone" placeholder="Cell Number*" required>
                <br>
                <label for="email"><b>Work Email:</b></label><br>
                <input type="email" id="email" name="email" placeholder="Email Address*" required>
                <br>
                <label for="agency"><b>Current Agency:</b></label><br>
                <input type="text" id="agency" name="agency" placeholder="Your Current Agency (if any)">
                <br>
                <label for="experience"><b>Years of Experience:</b></label><br>
                <input type="number" id="experience" name="experience" placeholder="Years of Experience (if applicable)" min="0" max="50">
                <br>
                <label for="specialization"><b>Specialization:</b></label><br>
                <select id="specialization" name="specialization">
                    <option value="">Select Specialization</option>
                    <option value="farm">Farm</option>
                    <option value="apartment">Apartment</option>
                    <option value="flat">Flat</option>
                    <option value="house">House</option>
                    <option value="townhouse">TownHouse</option>
                    <option value="land">Vacant Land</option>
                    <option value="duplex">Duplex</option>
                    <option value="cottage">Cottage</option>
                    <option value="other">Other</option>
                </select>
                <br>
                <label for="license"><b>Real Estate License Number:</b></label><br>
                <input type="text" id="license" name="license" placeholder="License Number (if applicable)">
                <br>
                <label for="bio"><b>Short Bio:</b></label><br>
                <textarea id="bio" name="bio" rows="4" placeholder="Tell us about your real estate experience or why you want to become an agent."></textarea>
                <br>
                <label>
                    <input type="checkbox" name="terms" required style="width: 9px;"> I agree to the <a href="#">terms and conditions</a>.
                </label><br>
                <br>
                <hr color="darkgray" size="2px" width="41%">
                <button type="submit">Submit</button>
                <hr color="white" size="5px">
            </form>
        </div>

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $agency = !empty($_POST['agency']) ? $_POST['agency'] : NULL;
                $experience = !empty($_POST['experience']) ? $_POST['experience'] : NULL;
                $specialization = !empty($_POST['specialization']) ? $_POST['specialization'] : NULL;
                $license = !empty($_POST['license']) ? $_POST['license'] : NULL;
                $bio = !empty($_POST['bio']) ? $_POST['bio'] : NULL;
                $host = 'localhost';
                $db = 'realhomeprop';
                $user = 'root';
                $pass = '';
                $conn = new mysqli($host, $user, $pass, $db);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $stmt = $conn->prepare("INSERT INTO agents (name, phone, email, agency, experience, specialization, license, bio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssisss", $name, $phone, $email, $agency, $experience, $specialization, $license, $bio);
                if ($stmt->execute()) {
                    echo "<p style='color: green;'>Registration successful! Welcome to RealHome.</p>";
                } else {
                    echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
                }
                $stmt->close();
                $conn->close();
            }
        ?>

    </body>
</html>