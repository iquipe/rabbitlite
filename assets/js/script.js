document.addEventListener('DOMContentLoaded', function() {
    // Preloader
    const preloader = document.getElementById('preloader');
    const mainContent = document.getElementById('main-content');
    window.addEventListener('load', function() {
        preloader.style.display = 'none';
        mainContent.style.display = 'block';
    });

    // Image Upload and Preview
    const imageUpload = document.getElementById('imageUpload');
    const imagePreview = document.getElementById('preview');
    const uploadButton = document.getElementById('uploadButton');
    const fileError = document.getElementById('file-error');
    const uploadFeedback = document.getElementById('upload-feedback');

    imageUpload.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (allowedTypes.includes(file.type)) {
                fileError.textContent = '';
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    uploadButton.disabled = false;
                };
                reader.readAsDataURL(file);
            } else {
                fileError.textContent = 'Invalid file type. Please select an image (JPEG, PNG, GIF).';
                imagePreview.style.display = 'none';
                uploadButton.disabled = true;
            }
        } else {
            imagePreview.style.display = 'none';
            uploadButton.disabled = true;
        }
    });

    // Upload Button (Placeholder)
    uploadButton.addEventListener('click', function() {
        uploadFeedback.textContent = 'Uploading...';
        // Simulate upload process
        setTimeout(() => {
            uploadFeedback.textContent = 'Upload successful!';
            uploadFeedback.classList.add('text-success');
        }, 2000);
    });
});
