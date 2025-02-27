<?php
session_start(); 



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('config.php'); 


    $username = $_POST['username'];
    $password = $_POST['password'];

  
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
     
        $user = $result->fetch_assoc();

        //verify password
        if (password_verify($password, $user['password_hash'])) {
          
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];

            header("Location: Marketplace.php");
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
    <link href="Stylesheet.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="main-content">
            <h2>Login</h2>

            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="CreateListing">Login</button>
            </form>

            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>
