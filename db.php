<?php
$host = 'localhost';
$dbname = 'user_system';
$user = 'root';
$pass = 'P@assw0rd';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    session_start();
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>