<?php
require 'db.php';

/**
 * Validates email format using PHP's built-in filter
 * @param string $email Email address to validate
 * @return bool Returns true if email format is valid, false otherwise
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Registers a new user in the database
 * @param PDO $pdo Database connection object
 * @param string $email User's email address
 * @param string $password User's password
 * @return string Returns status message indicating success or failure
 */
function registerUser($pdo, $email, $password) {
    if (!isValidEmail($email)) {
        $_SESSION['msg'] = 'error';
        return "Invalid email format.";
    }

    if (strlen($password) < 6) {
        $_SESSION['msg'] = 'error';
        return "Password must be at least 6 characters.";
    }

    // Check if email is already registered
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->fetch()) {
        $_SESSION['msg'] = 'error';
        return "This email is already registered.";
    }

    // Hash password and insert new user
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    try {
        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->execute(['email' => $email, 'password' => $hashedPassword]);
        unset($_SESSION['msg']);
        return "Registration successful!";
    } catch (PDOException $e) {
        return "Registration failed: " . $e->getMessage();
    }
}

/**
 * Authenticates user login credentials
 * @param PDO $pdo Database connection object
 * @param string $username User's username
 * @param string $password User's password
 * @return bool Returns true if login successful, false otherwise
 */
function loginUser($pdo, $username, $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        return true;
    }

    return false;
}

/**
 * Handles file upload with security checks
 * Allowed file types: JPEG, PNG, PDF
 * Maximum file size: 2MB
 * 
 * @param array $file $_FILES array containing upload information
 * @return string Returns status message about upload result
 */
function handleFileUpload($file) {
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($file['name']);

    // Validate file
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return "File upload error.";
    }
    if (!in_array(mime_content_type($file['tmp_name']), ['image/jpeg', 'image/png', 'application/pdf'])) {
        return "Only JPEG, PNG, or PDF files are allowed.";
    }
    if ($file['size'] > 2 * 1024 * 1024) { // 2MB limit
        return "File size exceeds 2MB.";
    }

    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        return "File uploaded successfully: $uploadFile";
    } else {
        return "File upload failed.";
    }
}
?>