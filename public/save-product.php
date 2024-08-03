<?php
require_once '../includes/productFunctions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sku = $_POST['sku'] ?? null;
    $name = $_POST['name'] ?? null;
    $price = $_POST['price'] ?? null;
    $productType = $_POST['productType'] ?? null;
    $size = $_POST['size'] ?? null;
    $weight = $_POST['weight'] ?? null;
    $height = $_POST['height'] ?? null;
    $width = $_POST['width'] ?? null;
    $length = $_POST['length'] ?? null;

    // Validate data
    if (!$sku || !$name || !$price || !$productType || ($productType === 'DVD' && !$size) || ($productType === 'Book' && !$weight) || ($productType === 'Furniture' && (!$height || !$width || !$length))) {
        $error_message = 'Please submit required data';
        include 'add-product.php';
        exit;
    }

    // Insert product into database
    $result = saveProduct($sku, $name, $price, $productType, $size, $weight, $height, $width, $length);

    if ($result === 'exists') {
        $error_message = 'This product already exists';
        include 'add-product.php';
        exit;
    } elseif ($result) {
        header('Location: index.php');
        exit;
    } else {
        $error_message = 'An error occurred. Please try again.';
        include 'add-product.php';
        exit;
    }
}

function saveProduct($sku, $name, $price, $productType, $size, $weight, $height, $width, $length) {
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'product_db');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if SKU already exists
    $sql = "SELECT COUNT(*) FROM products WHERE sku = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $sku);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        $conn->close();
        return 'exists';
    }

    // Insert product into database
    $sql = "INSERT INTO products (sku, name, price, type, size, weight, height, width, length)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsddddd", $sku, $name, $price, $productType, $size, $weight, $height, $width, $length);

    $result = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $result;
}
?>
