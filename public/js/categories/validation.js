function validateForm() {
    const name = document.getElementById('name').value;
    const image = document.getElementById('image').files[0];
    let valid = true;

    // Clear previous error messages
    document.getElementById('nameError').classList.add('d-none');
    document.getElementById('imageError').classList.add('d-none');
    document.getElementById('nameError').textContent = '';
    document.getElementById('imageError').textContent = '';

    // Validate name
    if (name.trim() === '') {
        document.getElementById('nameError').textContent = 'Name is required.';
        document.getElementById('nameError').classList.remove('d-none');
        valid = false;
    }

    // Validate image
    if (!image) {
        document.getElementById('imageError').textContent = 'Image is required.';
        document.getElementById('imageError').classList.remove('d-none');
        valid = false;
    } else if (!['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'].includes(image.type)) {
        document.getElementById('imageError').textContent = 'Invalid image type. Only JPEG, PNG, JPG, GIF, and SVG are allowed.';
        document.getElementById('imageError').classList.remove('d-none');
        valid = false;
    } else if (image.size > 2048 * 1024) {
        document.getElementById('imageError').textContent = 'Image size should not exceed 2MB.';
        document.getElementById('imageError').classList.remove('d-none');
        valid = false;
    }

    return valid;
}
