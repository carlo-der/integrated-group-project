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
            header("Location: marketplace.php");
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="Normalize.css" rel="stylesheet">
    <link href="RegisterStylesheet.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <div class="banner">
            <div class="Title">UniMarket Brighton</div>
        </div>
        <div class="main-content">
            <div class="BoxTitle">Register to UniMarket Brighton</div>
        <form action="register.php" method="POST">
            
            <input for="username" type="text" name="username" class="username" placeholder="Username" required>

            <input for="email" type="text" name="email" class="email" placeholder="Email" required>

            
            <input for="password" type="text" name="password" class="password" placeholder="Password" required>

            <input for="address" type="text" name="Address" class="address" placeholder="Address" required>

            <button class="Register" type="submit">Register</button>
        </form>
    </div>
</body>
</html>


