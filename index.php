<?php

include('config/db.php');

session_start();

$sql = "SELECT * FROM articles WHERE status = 'approved' ORDER BY published_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles_home.css">
    <title>Campus Chronicle</title>
</head>
<body>
    <?php include('includes/header.php'); ?>

    <main>
        <div class="header-title">
            <h1>Welcome to Campus Chronicle</h1>
        </div>

        <!-- Check if there are any published articles -->
        <?php if ($result->num_rows > 0): ?>
            <!-- Loop through all the published articles -->
            <?php while ($article = $result->fetch_assoc()): ?>
                <div class="article">
                    <h2><?php echo $article['title']; ?></h2>
                    <p><?php echo substr($article['content'], 0, 200); ?>...</p>
                    <a href="article.php?id=<?php echo $article['article_id']; ?>">Read More</a>
                    <small>Published on: <?php echo date('F j, Y', strtotime($article['published_at'])); ?></small>
                </div>
                <hr>
            <?php endwhile; ?>
        <?php else: ?>
            <!-- Message if no published articles are found -->
            <p>No articles have been published yet.</p>
        <?php endif; ?>
    </main>

    <?php include('includes/footer.php'); ?>
</body>
</html>
