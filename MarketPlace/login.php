<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('config.php'); 

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the query to find the user by username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password_hash'])) {
            // Start session and redirect to user portal
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];

            header("Location: marketplace.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No user found with that username.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="Normalize.css" rel="stylesheet">
    <link href="LoginStylesheet.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="banner">
            <div class="Title">UniMarket Brighton</div>
        </div>
            
        <div class="main-content">
            <div class="BoxTitle">Log in to UniMarket Brighton</div>
            
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

            <form class="form" action="login.php" method="POST">
                <div class="form-group">
                    <input type="text" name="username" class="username" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="password" placeholder="Password" required>
                </div>

                <button class="login" type="submit" class="CreateListing">Login</button>
            </form>

            <a href="register.php"><button class="register">Register</button></a>
        </div>
    </div>
</body>

</html>
