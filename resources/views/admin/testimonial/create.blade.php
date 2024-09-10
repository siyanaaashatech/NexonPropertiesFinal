@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Add Testimonial</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="toast align-items-center text-white bg-success border-0 position-fixed bottom-0 end-0 p-3"
                            role="alert" aria-live="assertive" aria-atomic="true" id="toastMessage">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Testimonial creation form -->
                    <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data" id="testimonialForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="designation">Designation</label>
                            <input type="text" name="designation" id="designation" class="form-control" value="{{ old('designation') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="review">Review</label>
                            <textarea name="review" id="review" class="form-control" rows="4" required>{{ old('review') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="rating">Rating</label>
                            <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" value="{{ old('rating') }}" required>
                        </div>

                        <!-- Image Upload with Cropper.js -->
                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control" required>
                        </div>

                        <!-- Crop Data Hidden Field -->
                        <input type="hidden" name="cropData" id="cropData">
                        
                        <!-- Hidden input to simulate array submission -->
                        <input type="hidden" name="image[]" id="croppedImage"> 

                        <!-- Cropped Image Preview -->
                        <div class="form-group mb-3" id="cropped-preview-container" style="display: none;">
                            <label>Cropped Image Preview:</label>
                            <img id="cropped-image-preview" style="max-width: 150%; max-height: 200%; display: block;">
                        </div>
                        

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

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create Testimonial</button>
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Image Cropping -->
<div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="image-preview" style="width: 100%; height: auto; display: none;">
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
let currentFiles = [];
let currentFileIndex = 0;

// Image file input change event
document.getElementById('image').addEventListener('change', function (e) {
    currentFiles = Array.from(e.target.files); // Store all selected files
    currentFileIndex = 0; // Start with the first file

    if (currentFiles.length > 0) {
        processNextFile();
    }
});

function processNextFile() {
    if (currentFileIndex >= currentFiles.length) return;

    const file = currentFiles[currentFileIndex];
    const url = URL.createObjectURL(file);
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

// Save cropped image data and update hidden input fields
document.getElementById('saveCrop').addEventListener('click', function () {
    if (!cropper) return;

    cropper.getCroppedCanvas().toBlob((blob) => {
        const reader = new FileReader();
        reader.readAsDataURL(blob); // Convert to base64 string
        reader.onloadend = function () {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'image[]'; // Ensure it's an array field
            hiddenInput.value = reader.result; // Set base64 string as the value
            document.getElementById('serviceForm').appendChild(hiddenInput);

            const croppedImagePreview = document.createElement('img');
            croppedImagePreview.src = reader.result;
            croppedImagePreview.style.maxWidth = '150%';
            croppedImagePreview.style.maxHeight = '200%';
            document.getElementById('cropped-preview-container').appendChild(croppedImagePreview);
            document.getElementById('cropped-preview-container').style.display = 'block';

            currentFileIndex++;
            processNextFile(); // Process the next file
        };

        const cropModal = bootstrap.Modal.getInstance(document.getElementById('cropModal'));
        cropModal.hide();
    }, 'image/png'); // Adjust the format as needed
});

</script>
@endsection