@extends('admin.layouts.master')

@section('content')
    @include('admin.includes.forms')

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Edit Blog</h1>
        </div>

        <!-- Blog update form -->
        <form id="updateForm" method="POST" action="{{ route('admin.blogs.update', ['blog' => $blog->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">
                <!-- Title -->
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $blog->title) }}" placeholder="Blog Title" required>
                </div>

                <!-- Description -->
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control summernote" id="description" required>{{ old('description', $blog->description) }}</textarea>
                </div>

                <!-- Keywords -->
                <div class="form-group mb-3">
                    <label for="keywords">Keywords</label>
                    <textarea name="keywords" id="keywords" class="form-control">{{ old('keywords', $blog->keywords) }}</textarea>
                </div>

                <!-- Author -->
                <div class="form-group mb-3">
                    <label for="author">Author</label>
                    <input type="text" name="author" class="form-control" id="author" value="{{ old('author', $blog->author) }}">
                </div>

                <!-- Image Upload with Cropper.js -->
                <div class="form-group mb-3">
                    <label for="image">Image</label>
                    <input type="file" id="image" class="form-control">
                </div>

                <!-- Crop Data Hidden Field -->
                <input type="hidden" name="cropData" id="cropData" value="{{ old('cropData') }}">

                <!-- Hidden input to simulate array submission -->
                <input type="hidden" name="image[]" id="croppedImage" value="{{ old('image[]') }}">

                <!-- Cropped Image Preview -->
                <div class="form-group mb-3" id="cropped-preview-container" style="display: {{ old('image[]') ? 'block' : 'none' }};">
                    <label>Cropped Image Preview:</label>
                    <img id="cropped-image-preview" src="{{ old('image[]') }}" style="max-width: 100%; max-height: 200%; display: block;">
                </div>

                <!-- Status -->
                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <div class="form-check">
                        <input type="radio" name="status" id="status_active" value="1" class="form-check-input" {{ old('status', $blog->status) == '1' ? 'checked' : '' }} required>
                        <label for="status_active" class="form-check-label">Active</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="status" id="status_inactive" value="0" class="form-check-input" {{ old('status', $blog->status) == '0' ? 'checked' : '' }} required>
                        <label for="status_inactive" class="form-check-label">Inactive</label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Blog</button>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>

        <!-- Modal for Image Cropping -->
        <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="image-preview" style="width: 100%; display: none;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="saveCrop" class="btn btn-primary">Save Crop</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include Cropper.js -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

        <script>
            let cropper;
            let currentFile;

            // Initialize Cropper.js for new image upload
            document.getElementById('image').addEventListener('change', function (e) {
                const files = e.target.files;
                if (files && files.length > 0) {
                    currentFile = files[0];
                    const url = URL.createObjectURL(currentFile);
                    const imagePreview = document.getElementById('image-preview');
                    imagePreview.src = url;
                    imagePreview.style.display = 'block';

                    // Show the crop modal
                    const cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
                    cropModal.show();

                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(imagePreview, {
                        aspectRatio: 16 / 9,
                        viewMode: 1,
                    });
                }
            });

            // Save cropped image data and update hidden input fields
            document.getElementById('saveCrop').addEventListener('click', function () {
                if (!cropper) return;

                const cropData = cropper.getData();
                document.getElementById('cropData').value = JSON.stringify({
                    width: Math.round(cropData.width),
                    height: Math.round(cropData.height),
                    x: Math.round(cropData.x),
                    y: Math.round(cropData.y),
                    
                });

                cropper.getCroppedCanvas().toBlob((blob) => {
                    const reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function () {
                        document.getElementById('croppedImage').value = reader.result;

                        // Set cropped image preview
                        const croppedImagePreview = document.getElementById('cropped-image-preview');
                        croppedImagePreview.src = reader.result;
                        document.getElementById('cropped-preview-container').style.display = 'block';
                    };

                    // Close modal after saving crop
                    const cropModal = bootstrap.Modal.getInstance(document.getElementById('cropModal'));
                    cropModal.hide();
                }, 'image/png');
            });

            // Initialize preview on page load if image exists
            window.addEventListener('load', function () {
                const croppedImage = document.getElementById('croppedImage').value;
                if (croppedImage) {
                    const croppedImagePreview = document.getElementById('cropped-image-preview');
                    croppedImagePreview.src = croppedImage;
                    document.getElementById('cropped-preview-container').style.display = 'block';
                }
            });
        </script>
    </div>
@endsection
