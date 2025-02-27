<?php
require_once('config.php');

// get items and user info
$query = "SELECT items.*, users.username FROM items INNER JOIN users ON items.seller_id = users.user_id";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MarketPlace</title>
    <link href="Normalize.css" rel="normalize">
    <link href="Stylesheet.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Banner Section -->
        <div class="banner">
            <div class="section-1">
                <h1>Title</h1>
                <h2>Marketplace</h2>
            </div>
            <div class="section-2">
                <input type="text" class="Username-input" placeholder="Username">
                <input type="text" class="Password-input" placeholder="Password">
                <a href="login.php">
                    <button>Login</button>
                </a>
                <a href="register.php">
                    <button>Register</button>
                </a>
                <input type="text" class="searchbar-input" placeholder="Search bar">
            </div>
        </div>

        <div class="content">
            <!-- Left Sidebar -->
            <div class="sidebar">
			<a href ="">
						<button class="Account">Account</button>
					</a>
					<a href = "create_listing.php">
						<button class="CreateListing">Create Listing</button>
					</a>
                
            </div>

            <!-- Main Content with Listings -->
            <div class="main-content">
                <div class="listings-container">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class="listing-card">
                            <img src="uploads/<?php echo $row['image']; ?>" alt="Item Image">
                            <h3><?php echo $row['title']; ?></h3>
                            <p>$<?php echo $row['price']; ?></p>
                            <p>Seller: <?php echo $row['username']; ?></p>
                            <a href="item_details.php?id=<?php echo $row['item_id']; ?>" class="view-details">View Details</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>



