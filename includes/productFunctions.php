<?php
// includes/productFunctions.php

require_once 'database.php';

function getAllProducts() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteProducts($ids) {
    global $pdo;
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("DELETE FROM products WHERE id IN ($placeholders)");
    return $stmt->execute($ids);
}
?>
