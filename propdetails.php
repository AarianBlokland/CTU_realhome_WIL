<!DOCTYPE html>
<!--propdetails.php-->
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
<html>
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
            table, tr, td {
                width: 100%;
                padding-top: auto;
                padding-bottom: auto;
            }
            .contact-form {
                margin-top: 20px;
                background-color: #f9f9f9;
                padding: 20px;
                border-radius: 5px;
            }
            .map {
                height: 300px;
                width: 100%;
                margin-top: 20px;
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
                <?php
                    $host = 'localhost';
                    $db = 'realhomeprop';
                    $user = 'root';
                    $pass = '';
                    $conn = new mysqli($host, $user, $pass, $db);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $property_id = $_GET['id'];
                    $query = "SELECT * FROM properties WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $property_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $property = $result->fetch_assoc();
                        echo "<h1>" . $property['bedrooms'] . " Bedroom " . ucfirst($property['property_type']) . "</h1>";
                        echo "<hr color='darkgray' size='2px' width='80%' align='left'>";
                        echo "<p>" . $property['property_bio'] . "</p>";
                        echo "<hr color='darkgray' size='2px' width='80%' align='left'>";
                        echo "<p>Price: " . $property['price'] . " ZAR</p>";
                        echo "<p>Status: " . ucfirst($property['status']) . "</p>";
                        echo "<p>Size: " . $property['size'] . " sqft</p>";
                        echo "<p>Bathrooms: " . $property['bathrooms'] . "</p>";
                        echo "<p>Levy: " . $property['levy'] . "</p>";
                        echo "<p>Utilities: " . $property['utilities'] . "</p>";
                        echo "<p>Features: " . $property['features'] . "</p>";
                        $image_urls = explode(',', str_replace(['[', ']'], '', $property['images']));
                        echo "<div class='slideshow-container'>";
                        foreach ($image_urls as $url) {
                            echo "<img class='property-image' src=" . trim($url) . " style='width: 100%; height: auto; margin-bottom: 10px;'>";
                        }
                        echo "</div>";
                        echo "<div id='map' class='map'></div>";
                        echo "<script>
                            function initMap() {
                                var location = {lat: " . $property['location_link'] . "};
                                var map = new google.maps.Map(document.getElementById('map'), {
                                    zoom: 15,
                                    center: location
                                });
                                var marker = new google.maps.Marker({
                                    position: location,
                                    map: map
                                });
                            }
                        </script>";
                        echo "<div class='contact-form'>";
                        echo "<h2>Contact Agent</h2>";
                        echo "<form action='contact_agent.php' method='POST'>";
                        echo "<input type='hidden' name='property_id' value='" . $property_id . "'>";
                        echo "<label for='name'>Your Name:</label><br>";
                        echo "<input type='text' id='name' name='name' required><br>";
                        echo "<label for='email'>Your Email:</label><br>";
                        echo "<input type='email' id='email' name='email' required><br>";
                        echo "<label for='message'>Message:</label><br>";
                        echo "<textarea id='message' name='message' rows='4' required></textarea><br>";
                        echo "<button type='submit'>Send Inquiry</button>";
                        echo "</form>";
                        echo "</div>";
                    } else {
                        echo "<p>Property not found.</p>";
                    }
                    $stmt->close();
                    $conn->close();
                ?>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap"></script>
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