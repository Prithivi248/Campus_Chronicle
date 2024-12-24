<?php
include('../config/db.php');
session_start();

// Ensure only admin users can approve articles
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    if (isset($_GET['id'])) {
        $article_id = $_GET['id'];

        // Prepare and execute the query to approve the article
        $sql = "UPDATE articles SET status = 'approved' WHERE article_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $article_id);

        if ($stmt->execute()) {
            // Redirect back to the manage articles page after approving
            header("Location: manage_articles.php?status=approved");
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Invalid article ID.";
    }
} else {
    echo "Access denied. Only admins can approve articles.";
}
?>
