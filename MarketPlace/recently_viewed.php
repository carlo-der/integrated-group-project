<?php

session_start();
if (!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

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
    <title>Recently Viewed</title> <!-- web page title -->
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
                <h1>Recently Viewed</h1>
			</div>
            <div class="section-2">
                

                <div class="popup" onclick="myFunction()">
                    <button class="Image">
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
                <a href="account.php"><button class="Account">Account</button></a>
                <a href="create_listing.php"><button class="CreateListing">Create Listing</button></a>
                <a href="your_listing.php"><button class="YourListing">Your listings</button></a>
                <a href="saved.php"><button class="Savedside">Saved</button></a>
                <a href="inbox.php"><button class="Inboxside">Inbox</button></a>
                <a href="enquirenow.php"><button class="Reviewsside">Message</button></a>
                <a href="reviews.php"><button class="Reviewsside">Reviews</button></a>
                <a href="settings.php"><button class="Settingsside">Settings</button></a>
            </div>

            <!-- Main Content with Listings -->
            <div class="main-content">
               
            </div>

            </div>
        </div>
    </div>
</body>
</html>
