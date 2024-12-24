<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_home.css"> 
    <link rel="stylesheet" href="article_styles.css"> 
    <title>Article Page</title>
</head>

<body>

    <?php
    include('config/db.php');
    include('includes/header.php');

    if (isset($_GET['id'])) {
        $article_id = $_GET['id'];
        $result = $conn->query("SELECT a.*, u.name AS author_name FROM articles a JOIN users u ON a.author_id = u.user_id WHERE a.article_id = $article_id");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <div class="article-container">
                <h1 class="article-title"><?php echo $row['title']; ?></h1>
                <div class="article-content">
                    <?php
                    $content = explode("\$", $row['content']); // Break content into paragraphs
                    foreach ($content as $paragraph) {
                        echo "<p>" . trim($paragraph) . "</p>";
                    }
                    ?>
                </div>
                <small class="article-meta">Written by <?php echo $row['author_name']; ?> on <?php echo $row['published_at']; ?></small>
            </div>
    <?php
        } else {
            echo "<p>Article not found.</p>";
        }
    } else {
        echo "<p>No article ID provided.</p>";
    }
    ?>

    <?php include('includes/footer.php'); ?>

</body>

</html>