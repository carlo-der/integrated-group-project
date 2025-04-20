<?php
session_start();
include 'config.php'; // Ensure this connects to MySQL

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to send messages.");
}


// Get logged-in user's ID and username
$user_id = $_SESSION['user_id'];

// Fetch messages where the user is either sender or receiver
$sql = "SELECT m.*, 
               sender.username AS sender_name, 
               receiver.username AS receiver_name
        FROM inbox m
        JOIN users sender ON m.sender_id = sender.user_id
        JOIN users receiver ON m.receiver_id = receiver.user_id
        WHERE m.receiver_id = ? OR m.sender_id = ?
        ORDER BY m.timestamp DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>




<!DOCTYPE html>
<html lang="en"> <!-- default language of the document content -->
<head>
    <meta charset="utf-8"> <!-- character encoding for the document (Unicode) -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Saved</title> <!-- web page title -->
    <link href="Normalize.css" rel="stylesheet"> <!-- Normalize CSS -->
    <link href="inbox.css" rel="stylesheet"> <!-- Custom styles -->
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
            <h1>Inbox</h1>

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
                    // Toggle popup function
                    function myFunction() {
                        var popup = document.getElementById("myPopup");
                        popup.classList.toggle("show");
                    }

                    function Darkmode() {
                        // Select all elements with the classes 'section-1' and 'section-2'
                        var elements = document.querySelectorAll('.section-1, .section-2, .sidebar, .main-content, body, .listing-card, .listing-card p, .listing-card h3, .section-3');
                        
                        // Loop through the selected elements and toggle the data-theme attribute
                        elements.forEach(function(element) {
                            element.setAttribute('data-theme', element.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
                        });
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
               <!-- <a href="recently_viewed.php"><button class="RecentlyViewedside">Recently Viewed</button></a> -->
                <a href="enquirenow.php"><button class="Reviewsside">Message</button></a>
                <!--<a href="reviews.php"><button class="Reviewsside">Reviews</button></a>-->
                <button onclick="Darkmode()"class="Settingsside">Settings</button></a>
            </div>

            <!-- Main Content with Listings -->
            <div class="main-content">
            <h2>Your Messages</h2>
            <br>
    
    <?php while ($row = $result->fetch_assoc()): ?>
        <p>
            <strong>From: <?php echo htmlspecialchars($row['sender_name']); ?></strong>  
            <br> 
            <strong>To: <?php echo htmlspecialchars($row['receiver_name']); ?></strong>
            <br>
            <?php echo nl2br(htmlspecialchars($row['message'])); ?>  
            <br>
            <small><?php echo $row['timestamp']; ?></small>
            <br>
            <a href="enquirenow.php"><button class="Reply">Reply</button></a>
            <br>
        </p>
        <hr>
    <?php endwhile; ?>
    
               
            </div>

            </div>
        </div>
    </div>
</body>
</html>
