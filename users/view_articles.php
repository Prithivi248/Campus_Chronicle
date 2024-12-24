<?php
// Start the session at the beginning of the script
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    header("Location: ../users/login.php"); // Redirect to login page if not logged in
    exit();
}

include('../config/db.php');
$userid = $_SESSION['user_id']; 

$result = $conn->query("SELECT * FROM articles WHERE author_id ='$userid'");
include('../includes/header.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles_home.css"> 
    <link rel="stylesheet" href="../user_styles.css"> 
    <title>View Articles</title>
</head>

<main>
    <div class="published-articles-container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="article-box">
                <h2><?php echo $row['title']; ?></h2>
                <p><?php echo $row['content']; ?></p>
                <small>Published on <?php echo date('F j, Y', strtotime($row['published_at'])); ?></small>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php include('../includes/footer.php'); ?>


