function validateForm() {
    const name = document.getElementById('name').value;
    const image = document.getElementById('image').files[0];
    let valid = true;
    let errorMessage = '';

    if (name.trim() === '') {
        errorMessage += 'Name is required.\n';
        valid = false;
    }

    if (!image) {
        errorMessage += 'Image is required.\n';
        valid = false;
    } else if (!['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'].includes(image.type)) {
        errorMessage += 'Invalid image type. Only JPEG, PNG, JPG, GIF, and SVG are allowed.\n';
        valid = false;
    } else if (image.size > 2048 * 1024) {
        errorMessage += 'Image size should not exceed 2MB.\n';
        valid = false;
    }

    if (!valid) {
        alert(errorMessage);
    }

    return valid;
}
