<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="realhome.css">
        <style>
            body{
                font-size: larger;
                background-size: cover;
                background-image: url('bgimg.png') !important;
            }
            button{
                background-color: #05f772;
                border: solid #05f772 5px;
                width: 130px;
                height: 30px;
                margin-bottom: 30px;
            }
            button:hover {
                background-color: #04d865;
                border: solid #04d865 5px;
            }
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <div class="loginwraper">
            <h1 style="color: #05f772;"><u>LOG IN</u></h1>
            <p style="font-size: small;">Please enter your Login info.</p>
            <hr color="darkgray" size="2px" width="70%">
            <form method="POST" ></form>
                <label for="email">Please enter your email</label><br>
                <input type="email" id="email" name="email" placeholder="janedoe@gmail.com" required autocomplete="email">
                <br>
                <label for="password">Please enter your password</label><br>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <br>
                <hr color="darkgray" width="41%">
                <button type="submit"><b>Login</b></button>
                <a href="signup.php">Sign Up?</a>
                <br>
            </form>
        </div>
        <?php
            session_start();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $host = 'localhost';
                $db = 'realhomeprop';
                $user = 'root';
                $pass = '';
                $conn = new mysqli($host, $user, $pass, $db);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($user_id, $name, $hashed_password);
            }
        ?>
    </body>
</html>