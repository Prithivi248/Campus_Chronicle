<?php
session_start();
include('../config/db.php');


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../users/login.php");
    exit();
}

$articles = $conn->query("SELECT a.*, u.username, c.name AS category_name 
                           FROM articles a 
                           JOIN users u ON a.author_id = u.user_id 
                           JOIN categories c ON a.category_id = c.category_id");

include('../includes/header.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles_home.css"> 
    <link rel="stylesheet" href="../admin_styles.css"> 
    <title>Admin Dashboard</title>
</head>

<table class="articles-table">
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $articles->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['category_name']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a href="approve.php?id=<?php echo $row['article_id']; ?>">Approve</a> | 
                <a href="reject.php?id=<?php echo $row['article_id']; ?>">Reject</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include('../includes/footer.php'); ?>
