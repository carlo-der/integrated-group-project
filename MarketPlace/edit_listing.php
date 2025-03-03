<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

$item_id = $_GET['id']; // Get the item ID from the URL
$user_id = $_SESSION['user_id'];

// Fetch item data from the database
$sql = "SELECT * FROM items WHERE item_id = ? AND seller_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $item_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated data from the form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Update item data in the database
    $update_sql = "UPDATE items SET title = ?, description = ?, price = ?, category_id = ? WHERE item_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssdii", $title, $description, $price, $category, $item_id);

    if ($update_stmt->execute()) {
        echo "Listing updated successfully!";
        header("Location: user_portal.php"); // Redirect back to portal
        exit();
    } else {
        echo "Error updating listing.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Listing</title>
</head>
<body>
    <h1>Edit Listing</h1>

    <form action="edit_listing.php?id=<?php echo $item['item_id']; ?>" method="POST">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo $item['title']; ?>" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required><?php echo $item['description']; ?></textarea><br>

        <label for="price">Price:</label>
        <input type="number" name="price" value="<?php echo $item['price']; ?>" required><br>

        <label for="category">Category:</label>
        <select name="category" required>
        <?php
                        require_once('config.php');
                        $sql = "SELECT category_id, category_name FROM categories";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                        }
                        ?>
        </select><br>

        <button type="submit">Update Listing</button>
    </form>
</body>
</html>
