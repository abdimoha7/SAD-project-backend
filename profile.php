<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please log in.");
}

echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "! This is your profile page.";
?>
