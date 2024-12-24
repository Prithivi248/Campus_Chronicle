<?php
include('../config/db.php');
session_start();

// Ensure only admin users can reject articles
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    if (isset($_GET['id'])) {
        $article_id = $_GET['id'];

        
        $sql = "UPDATE articles SET status = 'rejected' WHERE article_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $article_id);

        if ($stmt->execute()) {
           
            header("Location: manage_articles.php?status=rejected");
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Invalid article ID.";
    }
} else {
    echo "Access denied. Only admins can reject articles.";
}
?>
