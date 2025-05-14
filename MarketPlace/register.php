<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the registration form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address']; 

    // Hash the password before storing it
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, email, password_hash, address, created_at, updated_at) 
            VALUES (?, ?, ?, ?, NOW(), NOW())";

    // SQL statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssss", $username, $email, $passwordHash, $address);

        if ($stmt->execute()) {
            echo "Registration successful!";
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }
}

?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="Normalize.css" rel="stylesheet">
    <link href="RegisterStylesheet.css" rel="stylesheet">
    <style>
        /* Simple popup styling */
        #popup {
            display: none;
            position: fixed;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -30%);
            background-color: white;
            padding: 20px;
            border: 2px solid #000;
            z-index: 1000;
        }

        #overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="banner">
        <div class="Title">UniMarket Brighton</div>
    </div>
    <div class="main-content">
        <div class="BoxTitle">Register to UniMarket Brighton</div>

        <form id="registerForm" action="register.php" method="POST">
            <input type="text" name="username" class="username" placeholder="Username" required>
            <input type="text" name="email" class="email" placeholder="Email" required>
            <input type="password" name="password" class="password" placeholder="Password" required>
            <input type="text" name="address" class="address" placeholder="Address" required>

            <button type="button" class="Register" onclick="showPopup()">Register</button>
        </form>
    </div>
</div>

<!-- Popup -->
<div id="overlay"></div>

<div id="popup" class="websitepolicy">
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
    <button class="submit" onclick="submitForm()">I Agree</button>
    <button class="cancel" onclick="hidePopup()">Cancel</button>
</div>

<script>
function showPopup() {
    
    document.getElementById('popup').style.display = 'block';
}

function hidePopup() {
    
    document.getElementById('popup').style.display = 'none';
}

function submitForm() {
    document.getElementById('registerForm').submit();
}
</script>

</body>
</html>
