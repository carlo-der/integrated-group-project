<?php
session_start();
require_once('config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user's listings
$sql = "SELECT * FROM items WHERE seller_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Portal</title>
    <link href="Stylesheet.css" rel="stylesheet">
</head>
<body>
    <h1>Welcome to your portal, <?php echo $_SESSION['username']; ?>!</h1>
    <a href="marketplace.php">Back to Marketplace</a><br>

    <h2>Your Listings</h2>

    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <img src="uploads/<?php echo $row['image']; ?>" alt="Item Image" width="100">
                    <h3><?php echo $row['title']; ?></h3>
                    <p>Price: £<?php echo $row['price']; ?></p>
                    <p>Seller: <?php echo $_SESSION['username']; ?></p>
                    <a href="edit_listing.php?id=<?php echo $row['item_id']; ?>">Edit</a> |
                    <a href="delete_listing.php?id=<?php echo $row['item_id']; ?>">Delete</a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>You have no listings. <a href="create_listing.php">Create a new listing</a></p>
    <?php endif; ?>

</body>
</html>
