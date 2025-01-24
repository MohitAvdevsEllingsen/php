<?php
require 'db.php';
require 'auth.php';

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?></h1>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>Profile File: <a href="<?php echo htmlspecialchars($user['profile_file']); ?>" target="_blank">View</a></p>
    <a href="logout.php">Logout</a>
</body>
</html>
