<?php
session_start();
include('../config/db.php'); // Ensure this line is present to include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_id = $_SESSION['user_id'];
    $category_id = $_POST['category_id'];

    // Ensure that the database connection is available
    if ($conn) {
        $sql = "INSERT INTO articles (title, content, author_id, category_id, status) VALUES ('$title', '$content', '$author_id', '$category_id', 'pending')";
        if ($conn->query($sql) === TRUE) {
            echo "Article submitted for review!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Database connection failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles_home.css"> 
    <link rel="stylesheet" href="../user_styles.css"> 
    <title>Submit Articles</title>
</head>
<body>
    <?php include('../includes/header.php'); ?>

    <main>
        <form method="POST" action="">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id" required>
                <?php
                // Fetch categories from the database
                $categories = $conn->query("SELECT * FROM categories");
                while ($row = $categories->fetch_assoc()) {
                    echo "<option value='{$row['category_id']}'>{$row['name']}</option>";
                }
                ?>
            </select>

            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </main>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
