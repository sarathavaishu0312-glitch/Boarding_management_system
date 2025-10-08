<?php
include('db_config.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get all active gigs
$query = "SELECT gigs.*, users.username FROM gigs JOIN users ON gigs.user_id = users.id WHERE gigs.status='active' ORDER BY gigs.created_at DESC";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boarding Gigs - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <h2>Boarding Gigs</h2>
            <div class="nav-links">
                <span>Welcome, <?php echo $_SESSION['username']; ?></span>
                <?php if ($_SESSION['user_type'] == 'poster') { ?>
                    <a href="post_gig.php" class="btn">Post a Gig</a>
                <?php } ?>
                <a href="logout.php" class="btn btn-secondary">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Available Boarding Gigs</h1>
        
        <div class="gigs-grid">
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($gig = mysqli_fetch_assoc($result)) {
            ?>
                <div class="gig-card">
                    <?php if ($gig['photo']) { ?>
                        <img src="<?php echo $gig['photo']; ?>" alt="Gig Photo" class="gig-image">
                    <?php } else { ?>
                        <div class="gig-image-placeholder">No Image</div>
                    <?php } ?>
                    
                    <div class="gig-content">
                        <h3><?php echo $gig['title']; ?></h3>
                        <p class="gig-location">📍 <?php echo $gig['location']; ?></p>
                        <p class="gig-price">Rs. <?php echo number_format($gig['price'], 2); ?>/month</p>
                        <p class="gig-description"><?php echo substr($gig['description'], 0, 100); ?>...</p>
                        <p class="gig-poster">Posted by: <?php echo $gig['username']; ?></p>
                        
                        <div class="gig-actions">
                            <a href="view_gig.php?id=<?php echo $gig['id']; ?>" class="btn">View Details</a>
                        </div>
                    </div>
                </div>
            <?php
                }
            } else {
            ?>
                <p class="no-gigs">No gigs available at the moment.</p>
            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>
