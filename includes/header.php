<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles_home.css"> 
    <title>Campus Chronicle</title>
</head>
<body>
    <header>
        <h1>Campus Chronicle</h1>
        <nav>
            <a href="/campuschronicle/index.php">Home</a> 

            <?php if (isset($_SESSION['role'])): ?>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <!-- Admin-specific links -->
                    <a href="/campuschronicle/admin/dashboard.php">Admin Dashboard</a> 
                    <a href="/campuschronicle/admin/manage_articles.php">Manage Articles</a>
                    <a href="/campuschronicle/users/logout.php">Logout</a> 
                <?php elseif ($_SESSION['role'] == 'user'): ?>
                    <!-- Normal user-specific links -->
                    <a href="/campuschronicle/users/submit_article.php">Submit Article</a> 
                    <a href="/campuschronicle/users/view_articles.php">View Articles</a> 
                    <a href="/campuschronicle/users/logout.php">Logout</a> 
                <?php endif; ?>
            <?php else: ?>
                <!-- Links for guests (not logged in) -->
                <a href="/campuschronicle/users/register.php">Register</a> 
                <a href="/campuschronicle/users/login.php">Login</a> 
            <?php endif; ?>
        </nav>
    </header>
    <main>
