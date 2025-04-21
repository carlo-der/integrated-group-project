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
    <title>User Portal</title> <!-- web page title -->
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
            <h1>Welcome to your portal, <?php echo $_SESSION['username']; ?>!</h1>

                <div class="popup" onclick="myFunction()">
                    <button class="Image portal_settings_image">
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
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class="listing-card">
                            <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Item Image">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p>£<?php echo htmlspecialchars($row['price']); ?></p>
                            <p>Seller: <?php echo htmlspecialchars($row['username']); ?></p>
                            <a href="item_details.php?id=<?php echo $row['item_id']; ?>" class="view-details">View Details</a>
                        </div>
                    <?php } ?>
                </div>

                <div class="PortalSettings">
                            <div class="account_options"> Selling </div>
                            <div class="flex-container">
                                <button class="Listings">Your listings</button>
                                <button class="Accounts">Create New Listing</button>
                                <button class="Following">Listing Updates</button>
                            </div>
                        </div>

                        <div class="PortalSettings">
                            <div class="account_options"> Selling </div>
                            <div class="flex-container">
                                <button class="Listings">Your listings</button>
                                <button class="Accounts">Account</button>
                                <button class="Following">Following</button>
                            </div>
                        </div>
            </div>
            

            </div>
        </div>
    </div>
</body>
</html>
