<?php
session_start();
include 'config.php'; // Ensure this connects to MySQL

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to send messages.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender_id = $_SESSION['user_id']; // Logged-in user
    $receiver_username = $_POST['receiver_username']; // Username instead of user_id
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

    // Get receiver_id from username
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
    $stmt->bind_param("s", $receiver_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Error: The recipient does not exist.");
    }

    $receiver = $result->fetch_assoc();
    $receiver_id = $receiver['user_id']; // Get the user_id from username

    // Insert message into inbox table
    $sql = "INSERT INTO inbox (sender_id, receiver_id, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $sender_id, $receiver_id, $message);

    if ($stmt->execute()) {
        header("Location: inbox.php?success=1"); // Redirect to inbox
        exit();
    } else {
        $error = "Error sending message.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquire Now</title>
    <link href="Normalize.css" rel="stylesheet">
    <link href="enquirenow.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="banner">
            <div class="Title">UniMarket Brighton</div>
        </div>
            
        <div class="main-content">
        <div class="BoxTitle">Contact a User</div>
        
        <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>

        <form class="form" action="enquirenow.php" method="POST">
    <div class="form-group">
        <input type="text" name="receiver_username" class="username" placeholder="Username" required>
    </div>

    <div class="form-group">
        <input name="message" class="message" placeholder="Write your message here..." required>
    </div>

    <button class="send" type="submit">Send</button>
</form>

        <a href="Marketplace.php"><button class="Back">Cancel</button></a>
    </div>
    </div>
</body>
</html>
