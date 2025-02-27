<?php

require_once('config.php'); 


session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to create a listing.";
    exit;
}

$seller_id = $_SESSION['user_id'];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $image = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $imagePath = 'uploads/' . $image;

    echo "Title: $title <br> Description: $description <br> Price: $price <br> Category: $category <br>";
    echo "Image: $image <br>";

    if (move_uploaded_file($imageTmp, $imagePath)) {
        echo "Image uploaded successfully!<br>";

        $sql = "INSERT INTO items (title, description, price, category_id, image, listed_at, status, seller_id) 
                VALUES (?, ?, ?, ?, ?, NOW(), 'available', ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ssdisi", $title, $description, $price, $category, $image, $seller_id);

        if ($stmt->execute()) {
            echo "Listing added successfully!";
            header("Location: Marketplace.php"); 
        } else {
            echo "Error executing query: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error uploading image.<br>";
    }
} else {
    echo "Form not submitted.<br>";
}
?>


