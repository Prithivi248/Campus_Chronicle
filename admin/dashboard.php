<?php
session_start();
include('../config/db.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../users/login.php");
    exit();
}

// Fetch data
$total_users = $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0];
$total_articles = $conn->query("SELECT COUNT(*) FROM articles")->fetch_row()[0];
$total_categories = $conn->query("SELECT COUNT(*) FROM categories")->fetch_row()[0];

include('../includes/header.php');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles_home.css"> 
    <link rel="stylesheet" href="../admin_styles.css"> 
    <title>Admin Dashboard</title>
</head>

<main>
    
    <!-- Dashboard statistics in boxes -->
    <div class="dashboard">
        <div class="dashboard-box users">
            Total Registered Users: <?php echo $total_users; ?>
        </div>
        
        <div class="dashboard-box articles">
            Total Articles: <?php echo $total_articles; ?>
        </div>
        
        <div class="dashboard-box categories">
            Total Categories: <?php echo $total_categories; ?>
        </div>
    </div>
</main>

<?php include('../includes/footer.php'); ?>

