<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/addProduct.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-3">Add Product</h1>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form id="product_form" method="post" action="save-product.php">
            <div class="mb-3">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" class="form-control" id="sku" name="sku" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price ($)</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="productType" class="form-label">Type Switcher</label>
                <select class="form-select" id="productType" name="productType" required>
                    <option value="">Select Type</option>
                    <option value="DVD">DVD</option>
                    <option value="Book">Book</option>
                    <option value="Furniture">Furniture</option>
                </select>
            </div>
            <div class="mb-3" id="type-specific-attribute">
                <!-- Type-specific attributes will be injected here by JavaScript -->
            </div>
            <button type="submit" class="bt1 btn btn-primary">Save</button>
            <a href="index.php" class="bt2 btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('productType').addEventListener('change', function () {
            const typeSpecificAttribute = document.getElementById('type-specific-attribute');
            typeSpecificAttribute.innerHTML = ''; // Clear existing attributes

            switch (this.value) {
                case 'DVD':
                    typeSpecificAttribute.innerHTML = `
                        <label for="size" class="form-label">Size (MB)</label>
                        <input type="number" class="form-control" id="size" name="size" required>
                        <small>Please, provide size in MB</small>
                    `;
                    break;
                case 'Book':
                    typeSpecificAttribute.innerHTML = `
                        <label for="weight" class="form-label">Weight (KG)</label>
                        <input type="number" class="form-control" id="weight" name="weight" required>
                        <small>Please, provide weight in KG</small>
                    `;
                    break;
                case 'Furniture':
                    typeSpecificAttribute.innerHTML = `
                        <label for="height" class="form-label">Height (CM)</label>
                        <input type="number" class="form-control" id="height" name="height" required>
                        <label for="width" class="form-label">Width (CM)</label>
                        <input type="number" class="form-control" id="width" name="width" required>
                        <label for="length" class="form-label">Length (CM)</label>
                        <input type="number" class="form-control" id="length" name="length" required>
                        <small>Please, provide dimensions in CM</small>
                    `;
                    break;
            }
        });
    </script>
</body>
</html>
