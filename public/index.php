<?php
// public/index.php

require_once '../includes/productFunctions.php';

// Handle Mass Delete Request
if (isset($_POST['mass_delete'])) {
    $ids = $_POST['product_ids'] ?? [];
    if ($ids) {
        deleteProducts($ids);
        header('Location: index.php');
        exit;
    }
}

$products = getAllProducts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="head container mt-4">
        <!-- Header Row with Title and Add Product Button -->
        <div class="row mb-3 border-bottom pb-2 header-row">
            <div class="col-md-8">
                <h1 class="mb-0 product-list-title">Product List</h1>
            </div>
            <div class="col-md-4 text-end">
                <a href="add-product.php" class="btn btn-success add-product-btn">Add Product</a>
            </div>
        </div>

        <!-- Product Cards Row -->
        <form id="delete-form" method="post" action="index.php">
            <div class="row mb-3">
                <div class="col-md-12 text-end">
                    <button type="submit" name="mass_delete" class="btn btn-danger mass-delete-btn">Delete Products</button>
                </div>
            </div>
            <div class="row">
                <?php foreach ($products as $product): ?>   
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body d-flex flex-column align-items-center position-relative">
                                <!-- Checkbox positioned at the top left -->
                                <input type="checkbox" class="chk form-check-input position-absolute top-0 start-0 ms-3 mt-3" name="product_ids[]" value="<?php echo htmlspecialchars($product['id']); ?>">
                                <!-- Card Content -->
                                <div class="text-center">
                                    <p class="card-text"><strong></strong> <?php echo htmlspecialchars($product['sku']); ?></p>
                                    <p class="card-text"><strong></strong> <?php echo htmlspecialchars($product['name']); ?></p>
                                    <p class="card-text"><strong></strong> <?php echo number_format($product['price'], 2); ?>$</p>
                                    <?php if ($product['type'] === 'DVD'): ?>
                                        <p class="card-text"><strong>Size (MB):</strong> <?php echo htmlspecialchars($product['size']); ?></p>
                                    <?php elseif ($product['type'] === 'Book'): ?>
                                        <p class="card-text"><strong>Weight (Kg):</strong> <?php echo htmlspecialchars($product['weight']); ?></p>
                                    <?php elseif ($product['type'] === 'Furniture'): ?>
                                        <p class="card-text"><strong>Dimensions (HxWxL):</strong> 
                                            <?php echo htmlspecialchars($product['height']) . ' x ' . htmlspecialchars($product['width']) . ' x ' . htmlspecialchars($product['length']); ?></p>
                                    <?php endif; ?>           
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
