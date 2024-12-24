<?php
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $name = $_POST['name'];

    $sql = "INSERT INTO users (username, password, email, name, role) VALUES ('$username', '$password', '$email', '$name', 'user')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Registration successful!');
            window.location.href = '../index.php';
            </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles_home.css">
    <link rel="stylesheet" href="../styles.css">
    <title>Register</title>
    
</head>
<body>
    <form method="POST" action="" class="form-container">
        <h2>Welcome to Campus Chronicle</h2>
        <h2>Register</h2>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required placeholder="Enter your username">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required placeholder="Enter your email">

        <label for="name">Name</label>
        <input type="text" id="name" name="name" required placeholder="Enter your full name">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required placeholder="Enter your password">

        <button type="submit">Register</button>
    </form>
</body>
</html>
