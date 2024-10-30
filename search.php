<!DOCTYPE html>
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
            table {
                width: 100%;
                padding-top: 8px;
                padding-bottom: 8px;
                background-color: lightgray;
                border-radius: 10px;
                pad
            }
            th {
                border-right: solid gray 2px;
            }
            td {
                padding: auto;
                text-align: center;
            }
            button{
                background-color: #05f772;
                border: solid #05f772 5px;
                width: 130px;
                height: 30px;
            }
            button:hover  {
                background-color: #04d865;
              
                border: solid #04d865 5px;
            }
            input {
                width: 130px;
            }
            select {
                width:143px
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
                    <a href="login.html" class="loginlink">Login</a> |
                    <a href="signup.html" class="loginlink">Sign in</a>
                </p>
            </div>
        </header>

        <div class="content-wrapper">
            <div class="mainbody">
                <h1>Search Properties</h1>
                    <form method="POST" action="">
                        <table>
                            <tr>
                                <th><b><label for="price_range">Price Range (in ZAR):</label></b></th>
                                <th><b><label for="property_type">Property Type:</label></b></th>
                                <th><b><label for="bedrooms">Bedrooms:</label><br></b></th>
                                <th><b><label for="status">Status:</label></b></th>
                                <th style="border-right: none;"
                                ><b><label for="sort_by">Sort By:</label></b></th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" id="min_price" name="min_price" placeholder="Min Price">to
                                    <input type="number" id="max_price" name="max_price" placeholder="Max Price">
                                </td>
                                <td>
                                    <select id="property_type" name="property_type">
                                        <option value="" selected>Any Type</option>
                                        <option value="office">Office</option>
                                        <option value="apartment">Apartment</option>
                                        <option value="farm">Farm House</option>
                                        <option value="duplex">Duplex</option>
                                        <option value="flat">Flat</option>
                                        <option value="house">House</option>
                                        <option value="townhouse">Town-House</option>
                                        <option value="openland">Vacant Land</option>
                                        <option value="cottage">Cottage</option>
                                        <option value="other">Other</option>
                                    </select>
                                </td>
                                <td><input type="number" id="bedrooms" name="bedrooms" placeholder="Any" style="width:70px;"></td>
                                <td>
                                    <select id="status" name="status">
                                        <option value="" selected>Any Status</option>
                                        <option value="for_sale">For Sale</option>
                                        <option value="for_rent">For Rent</option>
                                    </select>
                                </td>
                                <td>
                                    <select id="sort_by" name="sort_by">
                                        <option value="price_asc">Price: Low to High</option>
                                        <option value="price_desc">Price: High to Low</option>
                                        <option value="size_asc">Size: Small to Large</option>
                                        <option value="size_desc">Size: Large to Small</option>
                                    </select>
                                </td>
                            </tr>
                        
                        </table>
                        <hr color="darkgray" width="41%">
                        <p align="center">
                            <button type="submit">Search</button>
                        </p>
                    </form>

                    <h2>Search Results:</h2>
                    <div class="propresults">
                        
                            <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $min_price = !empty($_POST['min_price']) ? $_POST['min_price'] : 0;
                                    $max_price = !empty($_POST['max_price']) ? $_POST['max_price'] : 100000000;
                                    $property_type = $_POST['property_type'];
                                    $bedrooms = !empty($_POST['bedrooms']) ? $_POST['bedrooms'] : 0;
                                    $status = $_POST['status'];
                                    $sort_by = $_POST['sort_by'];
                                    $host = 'localhost';
                                    $db = 'realhomeprop';
                                    $user = 'root';
                                    $pass = '';
                                    $conn = new mysqli($host, $user, $pass, $db);
                                    $query = "SELECT * FROM properties WHERE price >= ? AND price <= ?";
                                    $params = [];
                                    $param_types = "ii";

                                    if (!empty($property_type)) {
                                        $query .= " AND property_type = ?";
                                        $param_types .= "s";
                                        $params[] = $property_type;
                                    }
                                    if (!empty($bedrooms)) {
                                        $query .= " AND bedrooms >= ?";
                                        $param_types .= "i";
                                        $params[] = $bedrooms;
                                    }
                                    if (!empty($status)) {
                                        $query .= " AND status = ?";
                                        $param_types .= "s";
                                        $params[] = $status;
                                    }
                                    if ($sort_by == 'price_asc') {
                                        $query .= " ORDER BY price ASC";
                                    } elseif ($sort_by == 'price_desc') {
                                        $query .= " ORDER BY price DESC";
                                    } elseif ($sort_by == 'size_asc') {
                                        $query .= " ORDER BY size ASC";
                                    } elseif ($sort_by == 'size_desc') {
                                        $query .= " ORDER BY size DESC";
                                    }
                                    $stmt = $conn->prepare($query);
                                    $params = array_merge([$min_price, $max_price], $params);
                                    $stmt->bind_param($param_types, ...$params);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    
                                    if ($result->num_rows > 0) {
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
                                    } else {
                                        echo "<p>No properties match your criteria.</p>";
                                    }
            
                                    $stmt->close();
                                    $conn->close();
                                }
                            ?>
                    </div>
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
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const slideshows = document.querySelectorAll('.slideshow-container');
                slideshows.forEach(slideshow => {
                    let images = slideshow.querySelectorAll('.property-image');
                    let currentIndex = 0;
                    images[currentIndex].classList.add('active');
                    function showNextImage() {
                        images[currentIndex].classList.remove('active');
                        currentIndex = (currentIndex + 1) % images.length; // Loop back to the first image
                        images[currentIndex].classList.add('active');
                    }
                    setInterval(showNextImage, 3000);
                });
            });
        </script>
    </body>
</html>