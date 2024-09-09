@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Create New Property</h4>
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

                    <!-- Property creation form -->
                    <form action="{{ route('property.store') }}" method="POST" enctype="multipart/form-data" id="propertyForm">
                        @csrf
                        <input type="hidden" name="cropData" id="cropData">
                        <input type="hidden" name="main_image[]" id="croppedImage">

                        <!-- Title -->
                        <div class="form-group mb-3">
                            <label for="title">Property Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                        </div>

                        <!-- Description -->
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
                        </div>

                        <!-- Category -->
                        <div class="form-group mb-3">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">Choose Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sub Category -->
                        <div class="form-group mb-3">
                            <label for="sub_category_id">Sub Category</label>
                            <select name="sub_category_id" id="sub_category_id" class="form-control" required>
                                <option value="">Choose Sub Category</option>
                                @foreach($subCategories as $subCategory)
                                    <option value="{{ $subCategory->id }}" data-keywords="{{ $subCategory->meta_keywords }}" {{ old('sub_category_id') == $subCategory->id ? 'selected' : '' }}>
                                        {{ $subCategory->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Street -->
                        <div class="form-group mb-3">
                            <label for="street">Street</label>
                            <input type="text" name="street" id="street" class="form-control" value="{{ old('street') }}" required>
                        </div>

                        <!-- Suburb -->
                        <div class="form-group mb-3">
                            <label for="suburb">Suburb</label>
                            <input type="text" name="suburb" id="suburb" class="form-control" value="{{ old('suburb') }}" required>
                        </div>

                        <!-- State -->
                        <div class="form-group mb-3">
                            <label for="state">State</label>
                            <input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}" required>
                        </div>

                        <!-- Post Code -->
                        <div class="form-group mb-3">
                            <label for="post_code">Post Code</label>
                            <input type="text" name="post_code" id="post_code" class="form-control" value="{{ old('post_code') }}" required>
                        </div>

                        <!-- Country -->
                        <div class="form-group mb-3">
                            <label for="country">Country</label>
                            <input type="text" name="country" id="country" class="form-control" value="{{ old('country') }}">
                        </div>

                        <!-- Price -->
                        <div class="form-group mb-3">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
                        </div>

                        <!-- Price Type -->
                        <div class="form-group mb-3">
                            <label for="price_type">Price Type</label>
                            <select name="price_type" id="price_type" class="form-control" required>
                                <option value="fixed" {{ old('price_type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="negotiable" {{ old('price_type') == 'negotiable' ? 'selected' : '' }}>Negotiable</option>
                                <option value="on_request" {{ old('price_type') == 'on_request' ? 'selected' : '' }}>On Request</option>
                            </select>
                        </div>

                        <!-- Bedrooms -->
                        <div class="form-group mb-3">
                            <label for="bedrooms">Bedrooms</label>
                            <input type="number" name="bedrooms" id="bedrooms" class="form-control" value="{{ old('bedrooms') }}" required>
                        </div>

                        <!-- Bathrooms -->
                        <div class="form-group mb-3">
                            <label for="bathrooms">Bathrooms</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="form-control" value="{{ old('bathrooms') }}" required>
                        </div>

                        <!-- Area -->
                        <div class="form-group mb-3">
                            <label for="area">Area (sq ft)</label>
                            <input type="number" name="area" id="area" class="form-control" value="{{ old('area') }}" required>
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Availability Status -->
                        <div class="form-group mb-3">
                            <label for="availability_status">Availability Status</label>
                            <select name="availability_status" id="availability_status" class="form-control" required>
                                <option value="available" {{ old('availability_status') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="sold" {{ old('availability_status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                <option value="rental" {{ old('availability_status') == 'rental' ? 'selected' : '' }}>Rental</option>
                            </select>
                        </div>

                        <!-- Rental Period -->
                        <div class="form-group mb-3">
                            <label for="rental_period">Rental Period</label>
                            <input type="text" name="rental_period" id="rental_period" class="form-control" value="{{ old('rental_period') }}">
                        </div>

                        <!-- Main Image Upload with Cropper.js -->
                        <div class="form-group mb-3">
                            <label for="main_image">Main Image</label>
                            <input type="file" id="main_image" class="form-control" required>
                        </div>

                        <!-- Cropped Main Image Preview -->
                        <div class="form-group mb-3" id="cropped-preview-container" style="display: none;">
                            <label>Cropped Main Image Preview:</label>
                            <img id="cropped-image-preview" style="max-width: 150px; max-height: 200px; display: block;">
                        </div>

                        <!-- Other Images Upload -->
                        <div class="form-group mb-3">
                            <label for="other_images">Other Images</label>
                            <input type="file" id="other_images" class="form-control" name="other_images[]" multiple>
                        </div>

                        <!-- Other Images Preview -->
                        <div class="form-group mb-3" id="other-images-preview-container" style="display: none;">
                            <label>Selected Other Images Preview:</label>
                            <div id="other-images-preview" style="display: flex; flex-wrap: wrap;"></div>
                        </div>

                        <!-- Metadata Hidden Inputs -->
                        <input type="hidden" name="meta_title" id="meta_title" value="{{ old('meta_title') }}">
                        <input type="hidden" name="meta_description" id="meta_description" value="{{ old('meta_description') }}">
                        <input type="hidden" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}">

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create Property</button>
                            <a href="{{ route('property.index') }}" class="btn btn-secondary">Cancel</a>
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
    let currentFile;

    // Main image input change event
    document.getElementById('main_image').addEventListener('change', function (e) {
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

    // Preview for other images
    document.getElementById('other_images').addEventListener('change', function (e) {
        const files = e.target.files;
        const previewContainer = document.getElementById('other-images-preview');
        previewContainer.innerHTML = ''; // Clear previous previews
        document.getElementById('other-images-preview-container').style.display = 'block';

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function (event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.style.maxWidth = '100px';
                img.style.margin = '5px';
                img.style.border = '1px solid #ccc';
                img.style.padding = '2px';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });

    // Show toast message after form submission
    document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('.toast')) {
            const toast = new bootstrap.Toast(document.querySelector('.toast'));
            toast.show();
        }
    });

    // Update metadata fields based on property title input
    document.getElementById('title').addEventListener('input', updateMetadataFields);

    // Update metadata fields based on selected subcategory
    document.getElementById('sub_category_id').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const metaKeywords = selectedOption.getAttribute('data-keywords');
        document.getElementById('meta_keywords').value = metaKeywords;
    });

    function updateMetadataFields() {
        const title = document.getElementById('title').value;
        const metaTitle = document.getElementById('meta_title');
        const metaDescription = document.getElementById('meta_description');

        // Set metadata fields dynamically
        metaTitle.value = title;
        metaDescription.value = `Description for ${title}`;
    }
</script>
@endsection
