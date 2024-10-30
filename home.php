<!DOCTYPE html>
<?php
session_start();
function logInChecker() {
    if (isset($_SESSION['user_id'])) {
        // User is logged in, you can access session variables, for example:
        $user_name = $_SESSION['name'];
        echo'Hello '. $user_name .'';
    } else {
        echo'<a href="login.php" class="loginlink">Login</a> |';
        echo'<a href="signup.php" class="loginlink">Sign Up</a>';
    }
}
?>
<html lang="en">
    <head>
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
            table{
                width: 100%;
                padding-top: auto;
                padding-bottom: auto;
            }
            .imgsmall{
                width: 20px;
            }
            .infofooter {
  display: flex;
  flex: 1;
}
.infofooterextra {
  margin-right: 100px;
}
.contactinfo {
  margin: 0px;
  padding: 0px;
}
.contactinfo {
  list-style-type: none;
  margin: 0px;
  padding: 0px;
}
.sociallinks {
  display: flex;
  justify-content: left;
  gap: 10px; 
  padding: 10px 0;
}
.sociallinks a {
  display: inline-block;
  background-color: white;
  border-radius: 50%; 
  padding: 9px;
  transition: background-color 0.5s ease;
  text-decoration: none;
  color: Black;
}
.sociallinks a:hover {
  background-color: rgb(33, 45, 223);
}
.sociallinks img {
  width: 15px;
  height: 15px;
}
        </style>
    </head>
    <body>
        <header class="mainheader">
            <h1 class="title">RealHome</h1>
            <div style="margin-right: 10px;">
                <p align="right">
                    <?php
                        logInChecker();
                    ?>
                </p>
            </div>
        </header>

        <div class="content-wrapper">
            <div class="mainbody">
                <br>
                <br>
                <br>
                <br>
            </div>
            <div class="sidebar">
                <div class="navigation">
                    <table>
                        <th>
                            <td><a href="home.php" class="loginlink">Home</a></td>
                            <td><a herf="profile.php" class="loginlink">Profile</a></td>
                            <td><a href="submit.html" class="loginlink">Submition</a></td>
                            <td><a href="about.html" class="loginlink">About Us</a></td>
                            <td><a href="contact.html" class="loginlink">Contact Us</a></td>
                            <td><a href="search.php" class="loginlink">Search</a></td>
                        </th>
                    </table>
                </div>
        
                <div class="trending">
                    <h2>Top Agents</h2>
                    
                </div>
        
                <div class="ads">
                    <br>
                    <br>
                    <p align="center">Ad Here</p>
                    <br>
                    <br>
                </div>
            </div>
            
        </div>

        <footer class="mainfooter">
        <div class="infofooter">
            <div class="infofooterextra">
                <h2>Quick links</h2>
                <div class="sociallinks">
                    <nav>
                        <a href="https://www.facebook.com/CTUTrainingSolutions" target="_blank">
                            <img src="Facebook logo.png" alt="Facebook" class="imgsmall">
                        </a>
                        <a href="https://www.facebook.com/CTUTrainingSolutions" target="_blank">
                            <img src="Twitter logo.png" alt="Twitter" class="imgsmall">
                        </a>
                        <a href="https://www.youtube.com/user/1987ctu" target="_blank">
                            <img src="YouTube logo.png" alt="YouTube" class="imgsmall">
                        </a>
                        <a href="https://www.youtube.com/user/1987ctu" target="_blank">
                            <img src="LinkedIn logo.png" alt="LinkedIn" class="imgsmall">
                        </a>
                    </nav>
                </div>
                <p>
                    <a href="Home Page.html" class="betterlink">Home</a> | 
                    <a href="about.html" class="betterlink">About Us</a> | 
                    <a href="contact.html" class="betterlink">Contact Us</a>
                </p>
            </div>
            <div class="infofooterextra">
                <h2>Talk To Us</h2>
                <p>Contact us:
                    <ul class="contactinfo">
                        <li><a class="betterlink " href="mailto:customerservice@ctutraining.co.za">customerservice@ctutraining.co.za</a></li>
                        <li>081 750 4563 - Customer Service</li>
                        <li>0861 100 395 - National Contact Centre</li>
                    </ul>
                </p>
            </div>
        </div>
        <p><marquee>&copy; 2024 City Technical University, Aarian. All rights reserved.</marquee></p>
        </footer>
    </body>
</html>