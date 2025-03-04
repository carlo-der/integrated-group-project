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
    <link href="Stylesheet.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="address">Address:</label>
            <input type="text" name="address">

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>


