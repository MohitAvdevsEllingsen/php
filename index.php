<?php
// Include helper functions and database connection
require 'functions.php';

// Initialize session for user authentication and flash messages
session_start();

// Initialize variables for error and success messages
$error = '';
$message = '';

// Handle all POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            // Handle user registration
            case 'register':
                $res = registerUser($pdo, $_POST['email'], $_POST['password']);
                // Check if registration resulted in error
                if (isset($_SESSION['msg']) && isset($_SESSION['msg']) == 'error') {
                    $error = $res;
                } else {
                    $message = $res;
                }  
                break;

            // Handle user login
            case 'login':
                if (loginUser($pdo, $_POST['email'], $_POST['password'])) {
                    // Redirect to homepage after successful login
                    header("Location: index.php");
                    exit;
                } else {
                    $error = "Invalid email or password.";
                }
                break;

            // Handle user logout
            case 'logout':
                // Destroy session and redirect to homepage
                session_destroy();
                header("Location: index.php");
                exit;

            // Handle file upload
            case 'upload':
                // Verify user is logged in and file was uploaded
                if (isset($_SESSION['user_id']) && isset($_FILES['file'])) {
                    $message = handleFileUpload($_FILES['file']);
                } else {
                    $error = "You must be logged in to upload files.";
                }
                break;

            default:
                $error = "Invalid action.";
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User System</title>
</head>
<body>
    <h1>User Registration, Login, and File Upload</h1>

    <?php if ($error): ?>
        <!-- Display error messages in red -->
        <p style="color: red;"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <?php if ($message): ?>
        <!-- Display success messages in green -->
        <p style="color: green;"><?= htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Display user dashboard when logged in -->
        <p>Welcome, <?= htmlspecialchars($_SESSION['email']); ?>!</p>
        <!-- Logout form -->
        <form method="POST">
            <input type="hidden" name="action" value="logout">
            <button type="submit">Logout</button>
        </form>
        <!-- Include file upload form for logged-in users -->
        <?php include 'views/upload.php'; ?>
    <?php else: ?>
        <!-- Show registration and login forms for guests -->
        <?php include 'views/register.php'; ?>
        <?php include 'views/login.php'; ?>
    <?php endif; ?>
</body>
</html>
