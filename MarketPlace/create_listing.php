<?php
session_start();
if (!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Listing</title>
    <link href="Normalize.css" rel="stylesheet">
    <link href="Stylesheet.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="main-content">
            <h2>Create Your Listing</h2>
            <!-- Form to submit a new listing -->
            <form action="submit_listing.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="5" required></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" required>
                </div>

                <div class="form-group">
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
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Upload Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>

                <button type="submit" class="CreateListing">Submit Listing</button>
            </form>
        </div>
    </div>
</body>
</html>
