<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $new_password = $_POST['new_password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($new_password)) {
        die("Invalid input.");
    }

    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
    $stmt->execute([$password_hash, $email]);

    if ($stmt->rowCount() > 0) {
        echo "Password reset successfully.";
    } else {
        echo "Email not found.";
    }
}
?>
