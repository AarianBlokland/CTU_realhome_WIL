<!DOCTYPE html>
<?php
//session_start();

// Check if the user is logged in
//if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
//    header("Location: login.php");
//    exit();
//}
?>
<html lang="en">
    <head>
        <link rel="stylesheet" href="realhome.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            #loginwraper {                
                text-align: center;
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
                <br>
            </div>
        </header>

        <div class="content-wrapper">
            <div class="mainbody" id="loginwraper">
                <br>
                <h1>Submit a Property</h1>
                <p>Please fill out the form below to submit a property for listing.</p>
                
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="address">Property Address</label><br>
                    <textarea id="address" name="address" rows="8" placeholder="Enter the property address" required></textarea>
                    <br>
                    <label for="location_link">Location Link (Google Maps, etc.)</label><br>
                    <input type="url" id="location_link" name="location_link" placeholder="Paste a Google Maps link here">
                    <br>
                    <label for="property_type">Property Type</label><br>
                    <select id="property_type" name="property_type" required>
                        <option value="" disabled selected>Select property type</option>
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
                    <br>
                    <label for="property_bio">Property Bio/Description</label><br>
                    <textarea id="property_bio" name="property_bio" rows="10" placeholder="Describe the property" required></textarea>
                    <br>
                    <label for="status">Property Status</label><br>
                    <select id="status" name="status" required>
                        <option value="" disabled selected>Is it for sale or rent?</option>
                        <option value="for sale">For Sale</option>
                        <option value="for rent">For Rent</option>
                    </select>
                    <br>
                    <label for="price">Price (in ZAR)</label><br>
                    <input type="number" id="price" name="price" placeholder="Enter the price" required>
                    <br>
                    <label for="size">Size (m²)</label><br>
                    <input type="number" id="size" name="size" placeholder="Size in square meters (m²)" required>
                    <br>
                    <label for="levy">Levy (if applicable)</label><br>
                    <input type="number" id="levy" name="levy" placeholder="Monthly Levy amount (ZAR)">
                    <br>
                    <label for="utilities">Utilities</label><br>
                    <select id="utilities" name="utilities" required>
                        <option value="" disabled selected>Water and electricity availability</option>
                        <option value="water">Water Included</option>
                        <option value="elect">Electricity Included</option>
                        <option value="weboth">Both Water and Electricity Included</option>
                        <option value="none">Not Included</option>
                    </select>
                    <br>
                    <label for="bedrooms">Number of Bedrooms</label><br>
                    <input type="number" id="bedrooms" name="bedrooms" placeholder="Enter number of bedrooms" required>
                    <br>
                    <label for="bathrooms">Number of Bathrooms</label><br>
                    <input type="number" id="bathrooms" name="bathrooms" placeholder="Enter number of bathrooms" required>
                    <br>
                    <label for="property_images">Property Images (at least 10 images)</label><br>
                    <input type="file" id="property_images" name="property_images[]" accept="image/*" multiple required>
                    <br>
                    <label for="features">Additional Features (Optional)</label><br>
                    <textarea id="features" name="features" rows="3" placeholder="e.g., parking, garden, swimming pool, etc."></textarea>
                    <br>
                    <hr color="darkgray" width="41%">
                    <button type="submit">Submit Property</button><br>
                </form>
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
        <?php
            $host='localhost';
            $db='realhomeprop';
            $user='root';
            $pass=''; //might add later if needed
            $conn=new mysqli($host, $user, $pass, $db);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $address=$_POST['address'];
                $location_link=$_POST['location_link'];
                $property_type=$_POST['property_type'];
                $property_bio=$_POST['property_bio'];
                $status=$_POST['status'];
                $price=$_POST['price'];
                $size=$_POST['size'];
                $levy=!empty($_POST['levy']) ? $_POST['levy']:null;
                $utilities = $_POST['utilities'];
                $bedrooms = $_POST['bedrooms'];
                $bathrooms = $_POST['bathrooms'];
                $features = $_POST['features'];
                $image_files = $_FILES['property_images'];
                $image_paths = [];

                for ($i = 0; $i < count($image_files['name']); $i++) {
                    $image_name = $image_files['name'][$i];
                    $image_tmp_name = $image_files['tmp_name'][$i];
                    $upload_path = 'uploads/' . $image_name;
                    if (move_uploaded_file($image_tmp_name, $upload_path)) {
                        $image_paths[] = $upload_path;
                    }
                }

                $image_paths_json = json_encode($image_paths);
                $sql = "INSERT INTO properties (address, location_link, property_type, property_bio, status, price, size, levy, utilities, bedrooms, bathrooms, features, images) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                if ($levy === null) {
                    $levy=0;
                    $stmt->bind_param("sssssiiisiiss", $address, $location_link, $property_type, $property_bio, $status, $price, $size, $levy, $utilities, $bedrooms, $bathrooms, $features, $image_paths_json);
                } else {
                    $stmt->bind_param("sssssiiisiiss", $address, $location_link, $property_type, $property_bio, $status, $price, $size, $levy, $utilities, $bedrooms, $bathrooms, $features, $image_paths_json);
                }
                if ($stmt->execute()) {
                    echo "Property submitted successfully!";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
                $conn->close();
            }
        ?>
    </body>
</html>