@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Update Site Setting</h4>
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

                    <form action="{{ route('sitesettings.update', $siteSetting->id) }}" method="POST" enctype="multipart/form-data"
                        id="siteSettingsForm">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="office_title">Office Title</label>
                            <input type="text" name="office_title" id="office_title" class="form-control" value="{{ old('office_title', $siteSetting->office_title) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="office_address">Office Address</label>
                            <textarea name="office_address" id="office_address" class="form-control" rows="3"
                                required>{{ old('office_address', $siteSetting->office_address) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="office_contact">Office Contact</label>
                            <input type="text" name="office_contact" id="office_contact" class="form-control" value="{{ old('office_contact', implode(', ', is_array($siteSetting->office_contact) ? $siteSetting->office_contact : explode(', ', $siteSetting->office_contact))) }}">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="office_email">Office Email</label>
                            <input type="text" name="office_email" id="office_email" class="form-control" value="{{ old('office_email', implode(', ', is_array($siteSetting->office_email) ? $siteSetting->office_email : explode(', ', $siteSetting->office_email))) }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="office_description">Office Description</label>
                            <textarea name="office_description" id="office_description" class="form-control" rows="5">{{ old('office_description', $siteSetting->office_description) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="established_year">Established Year</label>
                            <input type="text" name="established_year" id="established_year" class="form-control"
                                value="{{ old('established_year', $siteSetting->established_year) }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="slogan">Slogan</label>
                            <input type="text" name="slogan" id="slogan" class="form-control"
                                value="{{ old('slogan', $siteSetting->slogan) }}">
                        </div>

                        <!-- Metadata fields -->
                        <div class="form-group mb-3">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" class="form-control" 
                                value="{{ old('meta_title', $siteSetting->metadata->meta_title ?? '') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="meta_description">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" rows="3"
                                >{{ old('meta_description', $siteSetting->metadata->meta_description ?? '') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="meta_keywords">Meta Keywords</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                                value="{{ old('meta_keywords', $siteSetting->metadata->meta_keywords ?? '') }}">
                        </div>

                        {{-- <!-- Image Upload with Cropper.js -->
                        <div class="form-group mb-3">
                            <label for="main_logo">Main Logo</label>
                            <input type="file" name="main_logo" id="main_logo" class="form-control">
                            @if($siteSetting->main_logo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $siteSetting->main_logo) }}" alt="Current Main Logo" style="max-width: 100%; height: auto;">
                                </div>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="side_logo">Side Logo</label>
                            <input type="file" name="side_logo" id="side_logo" class="form-control">
                            @if($siteSetting->side_logo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $siteSetting->side_logo) }}" alt="Current Side Logo" style="max-width: 100%; height: auto;">
                                </div>
                            @endif
                        </div> --}}

                        {{-- <!-- Crop Data Hidden Field -->
                        <input type="hidden" name="cropData" id="cropData">

                        <!-- Hidden input to simulate array submission -->
                        <input type="hidden" name="image[]" id="croppedImage"> 

                        <!-- Cropped Image Preview -->
                        <div class="form-group mb-3" id="cropped-preview-container" style="display: none;">
                            <label>Cropped Image Preview:</label>
                            <img id="cropped-image-preview" style="max-width: 100%; max-height: 200px; display: block;">
                        </div> --}}

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <input type="radio" name="status" id="status_active" value="1" class="form-check-input" {{ old('status', $siteSetting->status) == '1' ? 'checked' : '' }} required>
                                <label for="status_active" class="form-check-label">Active</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="status" id="status_inactive" value="0" class="form-check-input" {{ old('status', $siteSetting->status) == '0' ? 'checked' : '' }} required>
                                <label for="status_inactive" class="form-check-label">Inactive</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Site Setting</button>
                            <a href="{{ route('sitesettings.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <!-- Modal for Image Cropping -->
<div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="image-preview" style="max-width: 150%; max-height: 150%; display: none;">
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
        const cropData = cropper.getData();
        document.getElementById('cropData').value = JSON.stringify({
            width: Math.round(cropData.width),
            height: Math.round(cropData.height),
            x: Math.round(cropData.x),
            y: Math.round(cropData.y)
        });

        const base64Image = cropper.getCroppedCanvas().toDataURL('image/png');
        document.getElementById('croppedImage').value = base64Image; // Store the base64 string

        // Set cropped image preview
        const croppedImagePreview = document.getElementById('cropped-image-preview');
        croppedImagePreview.src = base64Image;
        document.getElementById('cropped-preview-container').style.display = 'block';

        // Close modal after saving crop
        const cropModal = bootstrap.Modal.getInstance(document.getElementById('cropModal'));
        cropModal.hide();
    });

    // Show toast message after form submission
    document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('.toast')) {
            const toast = new bootstrap.Toast(document.querySelector('.toast'));
            toast.show();
        }
    });
</script> --}}
@endsection