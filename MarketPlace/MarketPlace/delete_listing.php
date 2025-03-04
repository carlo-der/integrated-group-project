<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

$item_id = $_GET['id']; // Get the item ID from the URL
$user_id = $_SESSION['user_id'];

// Delete the item
$sql = "DELETE FROM items WHERE item_id = ? AND seller_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $item_id, $user_id);

if ($stmt->execute()) {
    echo "Listing deleted successfully!";
    header("Location: user_portal.php"); // Redirect back to portal
    exit();
} else {
    echo "Error deleting listing.";
}
?>
