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
<?php
$host = 'localhost';
$db = 'realhomeprop';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

// Function to display properties
function displayProperties($status, $limit) {
    global $conn;
    $query = "SELECT * FROM properties WHERE status = '$status' ORDER BY RAND() LIMIT $limit";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        echo "<div class='propsmall'>";
        echo "<div class='slideshow-container'>";
        
        $image_urls = $row['images'];
        $image_urls = str_replace(['[', ']'], '', $image_urls); 
        $url_array = explode(',', $image_urls);

        foreach ($url_array as $url) {
            $url = trim($url);
            echo "<img class='property-image' src=$url alt='Property Image' style='width: 100%; height: auto; margin-bottom: 10px;' />";
        }
        
        echo "</div>";
        echo "<div class='info'>";
        echo "<h3 style='color: #049e49;'>" . $row['bedrooms'] . " Bedroom " . ucfirst($row['property_type']) . "</h3>";
        echo "<p style='color: gray;'>" . ucfirst($row['status']) . " | " . $row['price'] . " ZAR<br>";
        echo "Location: " . $row['address'] . "</p>";
        echo "<hr color='darkgray' size='2px' width='90%' align=left>";
        echo "<p style='color: gray'>" . substr($row['property_bio'], 0, 100) . "</p>";
        echo "</div>";
        echo "</div>";
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
            .propresults{
                display: grid;
                grid-template-columns: 30% 30% 30%;
                margin: 5px;
            }
            .propsmall{
                width: 98%;
                border: solid lightgray 1px;
                margin: 1%;
                margin-left: 0%;
                padding: auto;
                overflow: hidden;
            }
            .info {
                overflow: hidden;
                height: 225px;
            }
            .slideshow-container {
                position: relative;
                width: 100%;
                height: 200px;
                overflow: hidden;
            }
            .property-image {
                display : none ; 
                position: absolute;

            }
            .property-image.active {
                display: block;
            }
            .imgsmall{
                width: 20px;
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
                <h1>Featured Sales</h1>
                <hr color="darkgray" width="41%" align="left">
                <div class="propresults">
                    <?php displayProperties('for sale', 6); ?>
                </div>

                <h1>Featured Rentals</h1>
                <hr color="darkgray" width="41%" align="left">
                <div class="propresults">
                    <?php displayProperties('for rent', 6); ?>
                </div>

            </div>
            <div class="sidebar">
                <div class="navigation">
                    <table>
                        <th>
                            <td><a href="home.php" class="loginlink">Home</a></td>
                            <td><a herf="profile.php" class="loginlink">Profile</a></td>
                            <td><a href="submit.php" class="loginlink">Submition</a></td>
                            <td><a href="about.html" class="loginlink">About Us</a></td>
                            <td><a href="contact.html" class="loginlink">Contact Us</a></td>
                            <td><a href="search.php" class="loginlink">Search</a></td>
                            <td><a href="regester.php" class="loginlink">regester as an agent</a></td>
                        </th>
                    </table>
                </div>
        
                <div class="trending">
                    <h2>Top Agents</h2>
                    <div>
                        <?php
                            $query = "SELECT name, experience FROM agents ORDER BY experience DESC LIMIT 5";
                            $result = $conn->query($query);
                            echo "<ol>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<li>" . $row['name'] . " - " . $row['experience'] . " years</li>";
                                echo "<hr color='darkgray' width='41%'' align='left' size='1px'>";
                            }
                            echo "</ol>";
                        ?>
                    </div>
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