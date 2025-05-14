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

            </div>
        </div>

        <div class="content">
            <!-- Left Sidebar -->
            <div class="sidebar">
            <a href="Marketplace.php"><button class="Marketplace">Home</button></a>
                <a href="create_listing.php"><button class="CreateListing">Create Listing</button></a>
                <a href="your_listing.php"><button class="YourListing">Your listings</button></a>
               <!-- <a href="recently_viewed.php"><button class="RecentlyViewedside">Recently Viewed</button></a> -->
                <a href="enquirenow.php"><button class="Reviewsside">Message</button></a>
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
