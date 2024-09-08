@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Create Site Setting</h4>
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

                    <form action="{{ route('sitesettings.store') }}" method="POST" enctype="multipart/form-data"
                        id="siteSettingsForm">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="office_title">Office Title</label>
                            <input type="text" name="office_title" id="office_title" class="form-control" value="{{ old('office_title') }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="office_address">Office Address</label>
                            <textarea name="office_address" id="office_address" class="form-control" rows="3"
                                required>{{ old('office_address') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="office_contact">Office Contact</label>
                            <textarea name="office_contact" id="office_contact" class="form-control" rows="3"
                                required>{{ old('office_contact') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="office_email">Office Email</label>
                            <textarea name="office_email" id="office_email" class="form-control" rows="3"
                                >{{ old('office_email') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="office_description">Office Description</label>
                            <textarea name="office_description" id="office_description" class="form-control" rows="5"
                                >{{ old('office_description') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="established_year">Established Year</label>
                            <input type="text" name="established_year" id="established_year" class="form-control"
                                value="{{ old('established_year') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="slogan">Slogan</label>
                            <input type="text" name="slogan" id="slogan" class="form-control"
                                value="{{ old('slogan') }}">
                        </div>

                        <!-- Metadata fields -->
                        <div class="form-group mb-3">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" class="form-control" 
                                value="{{ old('meta_title') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="meta_description">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" rows="3"
                                >{{ old('meta_description') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="meta_keywords">Meta Keywords</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                                value="{{ old('meta_keywords') }}">
                        </div>

                        <!-- Image Upload with Cropper.js -->
                        <div class="form-group mb-3">
                            <label for="main_logo">Main Logo</label>
                            <input type="file" name="main_logo" id="main_logo" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="side_logo">Side Logo</label>
                            <input type="file" name="side_logo" id="side_logo" class="form-control">
                        </div>

                        <!-- Crop Data Hidden Field -->
                        <input type="hidden" name="cropData" id="cropData">
                        
                        <!-- Hidden input to simulate array submission -->
                        <input type="hidden" name="image[]" id="croppedImage"> 

                        <!-- Cropped Image Preview -->
                        <div class="form-group mb-3" id="cropped-preview-container" style="display: none;">
                            <label>Cropped Image Preview:</label>
                            <img id="cropped-image-preview" style="max-width: 100%; max-height: 200px; display: block;">
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
                            <button type="submit" class="btn btn-primary">Create Site Setting</button>
                            <a href="{{ route('sitesettings.index') }}" class="btn btn-secondary">Cancel</a>
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
                <img id="image-preview" style="width: 100%; display: none;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveCrop" class="btn btn-primary">Save Crop</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
    let cropper;
    let currentFile;

    document.getElementById('main_logo').addEventListener('change', function (e) {
        const files = e.target.files;
        if (files && files.length > 0) {
            currentFile = files[0];
            const url = URL.createObjectURL(currentFile);
            const imagePreview = document.getElementById('image-preview');
            imagePreview.src = url;
            imagePreview.style.display = 'block';

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

                const croppedImagePreview = document.getElementById('cropped-image-preview');
                croppedImagePreview.src = reader.result;
                document.getElementById('cropped-preview-container').style.display = 'block';
            };

            const cropModal = bootstrap.Modal.getInstance(document.getElementById('cropModal'));
            cropModal.hide();
        }, 'image/png');
    });

    document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('.toast')) {
            const toast = new bootstrap.Toast(document.querySelector('.toast'));
            toast.show();
        }
    });
</script>
@endsection