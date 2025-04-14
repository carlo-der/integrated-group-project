<?php
require_once('config.php');

// Get items and user info
$query = "SELECT items.*, users.username FROM items INNER JOIN users ON items.seller_id = users.user_id";
$result = $conn->query($query);

// Check for query errors
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en"> <!-- default language of the document content -->
<head>
    <meta charset="utf-8"> <!-- character encoding for the document (Unicode) -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Listing</title> <!-- web page title -->
    <link href="Normalize.css" rel="stylesheet"> <!-- Normalize CSS -->
    <link href="Stylesheet.css" rel="stylesheet"> <!-- Custom styles -->
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;700&display=swap" rel="stylesheet"> <!-- Google font -->
</head>
<body>
    <div class="container">
        <!-- Banner Section -->
        <div class="banner">
            <div class="section-1">
				<h1>UniMarket Brighton</h1>
			</div>
            <div class="section-2">
                <h1>Create Listing</h1>
                <h4>Use this page to list items to sell</h4>
                

                <div class="popup" onclick="myFunction()">
                    <button class="Image settings_image">
                        <img src="settings_button1.png" alt="Image Button">
                    </button>
                    <span class="popuptext" id="myPopup">
                        <div class="Settingsection1">Settings</div>
                        <div class="Settingsection2">
                            <div class="popupheading"> General </div>
                            <div class="flex-container">
                                <button class="Saveditems">Saved items</button>
                                <button class="Inbox">Inbox</button>
                                <button class="Reviews">Reviews</button>
                                <button class="RecentlyViewed">Recently Viewed</button>
                            </div>
                        </div>
                        <div class="Settingsection3">
                            <div class="popupheading"> Selling </div>
                            <div class="flex-container">
                                <button class="Listings">Your listings</button>
                                <button class="Accounts">Account</button>
                                <button class="Following">Following</button>
                            </div>
                        </div>
                        <div class="Settingsection4">
                            <div class="popupheading"> Preferences </div>
                            <div class="flex-container">
                                <button class="Location">Location</button>
                                <button class="Notifications">Notifications</button>
                            </div>
                        </div>
                        <div class="Settingsection5">
                            <div class="popupheading"> Accessibility </div>
                            <div class="flex-container">
                                <button class="Colourblind">Colourblind filter</button>
                                <button class="Reader">Reader</button>
                            </div>
                        </div>
                    </span>
                </div>

                <script>
                    // When the user clicks on the button, toggle the popup
                    function myFunction() {
                        var popup = document.getElementById("myPopup");
                        popup.classList.toggle("show");
                    }
                </script>
            </div>
        </div>

        <div class="content">
            <!-- Left Sidebar -->
            <div class="sidebar">
            <a href="Marketplace.php"><button class="Marketplace">Home</button></a>
                <a href="user_portal.php"><button class="Account">Account</button></a>
                <a href="create_listing.php"><button class="CreateListing">Create Listing</button></a>
                
            </div>

            <!-- Main Content with Listings -->
            <div class="main-content">
                <div class="listings-container">
                <form action="submit_listing.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Product Name:</label>
                    <input type="text" id="title" name="title" required>
                    <br>
                    <br>

                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="10" required></textarea>
                    <br>
                    <br>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" required>
                    <br>
                    <br>
                
                </div>

                <div class="form-group">
                    <label for="category">Category:</label>
                    <select name="category" required>
                        <option value="" disabled selected>Please select a category</option> <!--Placeholder Option -->
                        <?php
                        require_once('config.php');
                        $sql = "SELECT category_id, category_name FROM categories";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <br>
                </div>

                <div class="form-group">
                    <label for="image">Upload Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                    <br>
                    <br>
                    <br>
                    
                </div>

                <button type="submit" class="SubmitListing">Submit Listing</button>
            </form>
                </div>
                
                
            </div>
            
                        
            </div>
        </div>
    </div>
</body>
</html>
