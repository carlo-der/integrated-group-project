<?php
require_once('config.php');
session_start(); // Start the session to access session variables

// Get search query if exists
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare SQL query
$query = "SELECT items.*, users.username FROM items INNER JOIN users ON items.seller_id = users.user_id";

// Modify query if search term is provided
if (!empty($searchQuery)) {
    $searchQuery = $conn->real_escape_string($searchQuery); // Sanitize input
    // Search for items whose title matches the search query exactly
    $query .= " WHERE items.title LIKE '%$searchQuery%'"; // Use LIKE for partial match
}

$result = $conn->query($query);

// Check for query errors
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MarketPlace</title>
    <link href="Normalize.css" rel="stylesheet">
    <link href="Stylesheet.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="banner">
            <div class="section-1">
                <h1>UniMarket Brighton</h1>
            </div>
            <div class="section-2">
                <!-- Search Bar Form -->
                <form method="GET" action="Marketplace.php"> <!-- Adjust action to the correct page if needed -->
                    <input type="text" name="search" class="searchbar-input" placeholder="Search items..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit" class="search-button">Search</button>
                </form>


                <script>
                    // Toggle popup function
                    function myFunction() {
                        var popup = document.getElementById("myPopup");
                        popup.classList.toggle("show");
                    }

 
    function Darkmode() {
        var elements = document.querySelectorAll('.section-1, .section-2, .sidebar, .main-content, body, .listing-card, .listing-card p, .listing-card h3, .section-3, .Image');
        var isDark = localStorage.getItem('theme') === 'dark';

        elements.forEach(function(element) {
            element.setAttribute('data-theme', isDark ? 'light' : 'dark');
        });

        localStorage.setItem('theme', isDark ? 'light' : 'dark');

        var settingsIcon = document.getElementById("settingsIcon");
        settingsIcon.src = isDark ? "settings_button.png" : "settings_button_dark.png";
    }

    // Apply theme on page load
    window.onload = function() {
        var theme = localStorage.getItem('theme') || 'light'; // Default to light
        var elements = document.querySelectorAll('.section-1, .section-2, .sidebar, .main-content, body, .listing-card, .listing-card p, .listing-card h3, .section-3, .Image');

        elements.forEach(function(element) {
            element.setAttribute('data-theme', theme);
        });

        var settingsIcon = document.getElementById("settingsIcon");
        settingsIcon.src = theme === 'dark' ? "settings_button_dark.png" : "settings_button.png";
    }
</script>

            </div>
        </div>

        <div class="content">
            <div class="sidebar">
                <a href="create_listing.php"><button class="CreateListing">Create Listing</button></a>
                <a href="your_listing.php"><button class="YourListing">Your listings</button></a>
                <!-- <a href="saved.php"><button class="Savedside">Saved</button></a>
                <a href="recently_viewed.php"><button class="RecentlyViewedside">Recently Viewed</button></a> -->
                <a href="inbox.php"><button class="Inboxside">Inbox</button></a>
                <a href="enquirenow.php"><button class="Reviewsside">Message</button></a>
                <!-- <a href="reviews.php"><button class="Reviewsside">Reviews</button></a> -->
                <button onclick="myFunction()" class="Settingsside">Settings</button>
                <div id="myPopup" class="popup">
                    <span>
                         <button class="Darkmode" onclick="Darkmode()">Darkmode / Lightmode</button>
<button class="websitepolicybutton" onclick="Websitepolicy()">Website Policy</button>

<div id="websitepolicy" class="websitepolicy">
   <span>
        <h1>Policies</h1>
        <br>

        <b>1. User accounts and Eligibility</b>
        <br>
        1.1 The website is used for students at the University of Brighton, and they must verify their identity by providing a university email.
        <br>
        1.2 The information provided by the users must be correct and only correlate to one account.
        <br>
        1.3 Impersonating someone else or false listing will result in account suspension.
        <br>
        1.4 It is the user's responsibility to keep their credentials safe.
        <br><br>

        <b>2. Listing policies</b>
        <br>
        2.1 Item’s description must be clear and in accuracy with the product advertised.
        <br>
        2.2 Items that break our community guidelines will be removed from the marketplace, and the account will be banned. These items include:
        <br>
        2.3 Illegal substances, weapons, and counterfeit goods.
        <br>
        2.4 Stolen items or items that violate university policies.
        <br>
        2.5 Services that involve academic dishonesty.
        <br>

        2.6 Items must be categorized and priced fairly.
        <br>
        2.7 Listings that seem to be of false and misleading description will be removed.
        <br><br>

        <b>3. Buying and selling guidelines</b>
        <br>
        3.1 The seller must be aware that there is no payment system set up on the website. Payment must be done in person or externally to this website. Sharing payment details is strictly prohibited and will result in account termination.
        <br><br>

        <b>4. Returns and refunds</b>
        <br>
        4.1 The buyer must contact the seller within two weeks of the initial purchase date to request a return or refund.
        <br>
        4.2 Returns and refunds are at the seller's discretion.
        <br><br>

        <b>5. Content and community standards</b>
        <br>
        5.1 Every user must follow respectful and professional communication.
        <br>
        5.2 Inappropriate content or harassment of any type will not be tolerated.
        <br>
        5.3 Reviews must be honest and based on the actual purchased product.
        <br><br>

        <b>6. Violations and enforcement</b>
        <br>
        6.1 Users that violate the policies may face actions, like account suspension or banning, listing removals, and a notice.
        <br>
        6.2 If the violations are repeated, the account will be permanently banned.
        <br>
        6.3 The marketplace has the right to change or remove any content that does not align with these policies.
        <br><br>

        <b>7. Amendments and updates</b>
        <br>
        7.1 Policies might have to be updated from time to time to improve security and user experience.
        <br>
        7.2 Users must be notified of any changes in policies.
<br><br>
        
            </span>
</div>

                       
                        <a href="login.php"><button class="Logout">Log out</button></a>
                        
                    </span>
                </div>


            </div>

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
            </div>

            <?php if (!isset($_SESSION['user_id'])) { // Check if the user is logged in ?>
            <div class="bottombar">
                <div class="section-3">
                    <div class="banner-text">Sign up or log in today to start buying and selling with ease!</div>
                    <a href="login.php" class="Login-banner">Login</a>
                    <a href="register.php" class="Register-banner">Register</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    

                <script>
                    // Toggle popup function
                  // Toggle popup function
function myFunction() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}

// Close popup if click is outside the popup or button
document.addEventListener('click', function(event) {
    var popup = document.getElementById("myPopup");
    var settingsButton = document.querySelector('.Settingsside'); // The button that triggers the popup

    // If the click is outside the popup and the settings button, close the popup
    if (!popup.contains(event.target) && event.target !== settingsButton) {
        popup.classList.remove("show");
    }
});

// Toggle website policy popup function
function Websitepolicy() {
    var popup = document.getElementById("websitepolicy");
    popup.classList.toggle("show");
}

// Close website policy popup if click is outside
document.addEventListener('click', function(event) {
    var policyPopup = document.getElementById("websitepolicy");
    var policyButton = document.querySelector('.websitepolicybutton'); // The button that triggers the policy popup

    // If the click is outside the policy popup and the policy button, close the popup
    if (!policyPopup.contains(event.target) && event.target !== policyButton) {
        policyPopup.classList.remove("show");
    }
});


 
    function Darkmode() {
        var elements = document.querySelectorAll('.section-1, .section-2, .sidebar, .main-content, body, .listing-card, .listing-card p, .listing-card h3, .section-3, .Image');
        var isDark = localStorage.getItem('theme') === 'dark';

        elements.forEach(function(element) {
            element.setAttribute('data-theme', isDark ? 'light' : 'dark');
        });

        localStorage.setItem('theme', isDark ? 'light' : 'dark');

        var settingsIcon = document.getElementById("settingsIcon");
        settingsIcon.src = isDark ? "settings_button.png" : "settings_button_dark.png";
    }

    // Apply theme on page load
    window.onload = function() {
        var theme = localStorage.getItem('theme') || 'light'; // Default to light
        var elements = document.querySelectorAll('.section-1, .section-2, .sidebar, .main-content, body, .listing-card, .listing-card p, .listing-card h3, .section-3, .Image');

        elements.forEach(function(element) {
            element.setAttribute('data-theme', theme);
        });

        var settingsIcon = document.getElementById("settingsIcon");
        settingsIcon.src = theme === 'dark' ? "settings_button_dark.png" : "settings_button.png";
    }

</script>
</body>
</html>
