<?php
// includes/database.php

$host = 'localhost';  // Change this to your host if different
$dbname = 'product_db';  // Your database name
$user = 'root';  // Your database username
$pass = '';  // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
