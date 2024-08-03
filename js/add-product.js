document.addEventListener('DOMContentLoaded', function () {
    const productType = document.getElementById('productType');
    const typeSpecificAttributes = document.getElementById('typeSpecificAttributes');
    const form = document.getElementById('product_form');
    const notifications = document.getElementById('notifications');

    productType.addEventListener('change', function () {
        switch (this.value) {
            case 'DVD':
                typeSpecificAttributes.innerHTML = `
                    <div class="mb-3">
                        <label for="size" class="form-label">Size (MB)</label>
                        <input type="number" step="1" class="form-control" id="size" name="size" required>
                        <small class="form-text text-muted">Please, provide size in MB</small>
                    </div>
                `;
                break;
            case 'Book':
                typeSpecificAttributes.innerHTML = `
                    <div class="mb-3">
                        <label for="weight" class="form-label">Weight (KG)</label>
                        <input type="number" step="0.01" class="form-control" id="weight" name="weight" required>
                        <small class="form-text text-muted">Please, provide weight in KG</small>
                    </div>
                `;
                break;
            case 'Furniture':
                typeSpecificAttributes.innerHTML = `
                    <div class="mb-3">
                        <label for="height" class="form-label">Height (CM)</label>
                        <input type="number" step="0.01" class="form-control" id="height" name="height" required>
                    </div>
                    <div class="mb-3">
                        <label for="width" class="form-label">Width (CM)</label>
                        <input type="number" step="0.01" class="form-control" id="width" name="width" required>
                    </div>
                    <div class="mb-3">
                        <label for="length" class="form-label">Length (CM)</label>
                        <input type="number" step="0.01" class="form-control" id="length" name="length" required>
                        <small class="form-text text-muted">Please, provide dimensions in HxWxL format</small>
                    </div>
                `;
                break;
            default:
                typeSpecificAttributes.innerHTML = '';
        }
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        notifications.innerHTML = '';

        const formData = new FormData(form);
        let valid = true;

        for (let [key, value] of formData.entries()) {
            if (!value.trim()) {
                notifications.innerHTML = `<div class="alert alert-danger">Please, submit required data</div>`;
                valid = false;
                break;
            }
        }

        if (valid) {
            fetch('save-product.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = 'index.php';
                    } else {
                        notifications.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                    }
                })
                .catch(error => {
                    notifications.innerHTML = `<div class="alert alert-danger">An error occurred. Please try again.</div>`;
                });
        }
    });
});
