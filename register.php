<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $file = $_FILES['profile_file'];

    $uploadDir = 'upload/';
    $filePath = $uploadDir . basename($file['name']);
    move_uploaded_file($file['tmp_name'], $filePath);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, profile_file) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$username, $email, $password, $filePath]);
        header("Location: index.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
    <h1>Register</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="file" name="profile_file" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
