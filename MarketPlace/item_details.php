<?php
require_once('config.php');

$item_id = $_GET['id'];

//getting the item details
$query = "SELECT items.*, users.username FROM items INNER JOIN users ON items.seller_id = users.user_id WHERE items.item_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $item_id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details</title>
    <link rel="stylesheet" href="Stylesheet.css">
</head>
<body>

    <div class="container">
        <h2>Item Details</h2>

        <div class="item-detail">
            <img src="uploads/<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
            <h3><?php echo $item['title']; ?></h3>
            <p><strong>Price:</strong> £<?php echo $item['price']; ?></p>
            <p><strong>Description:</strong> <?php echo $item['description']; ?></p>
            <p><strong>Seller:</strong> <?php echo $item['username']; ?></p>
        </div>
    </div>

</body>
</html>
