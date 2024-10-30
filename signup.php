<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="realhome.css">
        <style>
            body{
                font-size: larger;
                background-size: cover;
                background-attachment: scroll;
                background-image: url("bgimg.png") !important;
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
            <h1 style="color: #05f772;"><u>Sign Up</u></h1>
            <p style="font-size: small;">Please enter your personal information.</p>
            <hr color="darkgray" size="2px" width="70%"> 

            <form style="margin-bottom: 10px;" method="post">
                <label for="name"><b>Name:</b></label><br>
                <input type="text" id="name" name="name" placeholder="Name*" required>
                <br>
                <label for="cell"><b>Cellphone Number:</b></label><br>
                <input type="tel" id="cell" name="cell" placeholder="Cell Number">
                <br>
                <label for="email"><b>Email</b></label><br>
                <input type="email" id="email" name="email" placeholder="Email*" required autocomplete="email">
                <br>
                <label for="password"><b>Password</b></label><br>
                <input type="password" id="password" name="password" placeholder="Password*" required autocomplete="password">
                <br>
                <label for="address"><b>Home Address:</b></label><br>
                <textarea id="address" name="address" placeholder="Address*" required rows="4"></textarea>
                <br>
                <hr color="darkgray" size="2px" width="41%">
                <button type="submit"><b>Sign Up</b></button>
            </form>
        </div>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $cell = $_POST['cell'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $address = $_POST['address'];
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $host = 'localhost';
                $db = 'realhomeprop';
                $user = 'root';
                $pass = '';
                $conn = new mysqli($host, $user, $pass, $db);
                if ($conn->connect_error) {
                    die('Connection failed: '. $conn->connect_error);
                }
                $stmt = $conn->prepare("INSERT INTO users (name, cell, email, password, address) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $name, $cell, $email, $hashed_password, $address);
                if ($stmt->execute()) {
                    echo "<p style='color:green;'>Sign Up successful! Please <a href='login.php'>log in</a>.</p>";
                } else {
                    echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
                }
                $stmt->close();
                $conn->close();
            }
        ?>
    </body>
</html>