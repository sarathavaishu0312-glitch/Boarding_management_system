<?php
include('db_config.php');

// Ensure session started (if db_config.php doesn't already start it)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get all active gigs
$query = "SELECT gigs.*, users.username FROM gigs JOIN users ON gigs.user_id = users.id WHERE gigs.status='active' ORDER BY gigs.created_at DESC";
$result = mysqli_query($connection, $query);

if ($result === false) {
    // Log error in server logs and show user-friendly message
    error_log('DB error in index.php: ' . mysqli_error($connection));
    $gigs = [];
} else {
    $gigs = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
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
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest', ENT_QUOTES, 'UTF-8'); ?></span>
                <?php if (!empty($_SESSION['user_type']) && $_SESSION['user_type'] === 'poster') { ?>
                    <a href="post_gig.php" class="btn">Post a Gig</a>
                <?php } ?>
                <a href="logout.php" class="btn btn-secondary">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Available Boarding Gigs</h1>

        <div class="gigs-grid">
            <?php if (!empty($gigs)) {
                foreach ($gigs as $gig) {
                    $title = htmlspecialchars($gig['title'] ?? '', ENT_QUOTES, 'UTF-8');
                    $location = htmlspecialchars($gig['location'] ?? '', ENT_QUOTES, 'UTF-8');
                    $price = isset($gig['price']) ? number_format((float)$gig['price'], 2) : '0.00';
                    $description = htmlspecialchars(mb_substr($gig['description'] ?? '', 0, 100, 'UTF-8'), ENT_QUOTES, 'UTF-8');
                    $username = htmlspecialchars($gig['username'] ?? '', ENT_QUOTES, 'UTF-8');
                    $photo = $gig['photo'] ?? '';
                    // Optional: validate/whitelist $photo or build path to local images
            ?>
                <div class="gig-card">
                    <?php if (!empty($photo)) { ?>
                        <img src="<?php echo htmlspecialchars($photo, ENT_QUOTES, 'UTF-8'); ?>" alt="Gig Photo" class="gig-image">
                    <?php } else { ?>
                        <div class="gig-image-placeholder">No Image</div>
                    <?php } ?>

                    <div class="gig-content">
                        <h3><?php echo $title; ?></h3>
                        <p class="gig-location">📍 <?php echo $location; ?></p>
                        <p class="gig-price">Rs. <?php echo $price; ?>/month</p>
                        <p class="gig-description"><?php echo $description; ?>...</p>
                        <p class="gig-poster">Posted by: <?php echo $username; ?></p>

                        <div class="gig-actions">
                            <a href="view_gig.php?id=<?php echo (int)$gig['id']; ?>" class="btn">View Details</a>
                        </div>
                    </div>
                </div>
            <?php
                }
            } else {
            ?>
                <p class="no-gigs">No gigs available at the moment.</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>
