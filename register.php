<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email.");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
    try {
        $stmt->execute([$username, $email, $password_hash]);
        echo "Registration successful!";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            die("Username or email already exists.");
        }
        die("Error: " . $e->getMessage());
    }
}
?>
