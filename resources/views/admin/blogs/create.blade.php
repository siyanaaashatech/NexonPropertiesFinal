@extends('admin.layouts.master')

@section('content')
    @include('admin.includes.forms')

    <div class="card-header">
        <h1 class="card-title">Add Blog</h1>
    </div>

    <!-- Blog creation form -->
    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
        @csrf

        <!-- Title -->
        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

       <!-- Description -->
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea class="form-control summernote" id="description" name="description" rows="10" required>{{ old('description') }}</textarea>
        </div>

        <!-- Keywords -->
        <div class="form-group mb-3">
            <label for="keywords">Keywords</label>
            <textarea name="keywords" id="keywords" class="form-control">{{ old('keywords') }}</textarea>
        </div>

        <!-- Author -->
        <div class="form-group mb-3">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" class="form-control" value="{{ old('author') }}">
        </div>

        <!-- Image Upload with Cropper.js -->
        <div class="form-group mb-3">
            <label for="image">Image</label>
            <input type="file" id="image" class="form-control" required>
        </div>

        <!-- Crop Data Hidden Field -->
        <input type="hidden" name="cropData" id="cropData">

        <!-- Hidden input to simulate array submission -->
        <input type="hidden" name="image[]" id="croppedImage"> 

        <!-- Cropped Image Preview -->
        <div class="form-group mb-3" id="cropped-preview-container" style="display: none;">
            <label>Cropped Image Preview:</label>
            <img id="cropped-image-preview" style="max-width: 100%; max-height: 200%; display: block;">
        </div>

        <!-- Status -->
        <div class="form-group mb-3">
            <label for="status">Status</label>
            <div class="form-check">
                <input type="radio" name="status" id="status_active" value="1" class="form-check-input" {{ old('status') == '1' ? 'checked' : '' }} required>
                <label for="status_active" class="form-check-label">Active</label>
            </div>
            <div class="form-check">
                <input type="radio" name="status" id="status_inactive" value="0" class="form-check-input" {{ old('status') == '0' ? 'checked' : '' }} required>
                <label for="status_inactive" class="form-check-label">Inactive</label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create Blog</button>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Summernote CSS and JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

    <!-- Include Cropper.js CSS and JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,   // Set editor height
                minHeight: 200, // Set minimum height of editor
                maxHeight: 500, // Set maximum height of editor
                focus: true    // Set focus to editable area after initializing summernote
            });
        });

        let cropper;
        let currentFile;

        // Image file input change event
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
                y: Math.round(cropData.y)
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
    </script>
@endsection
