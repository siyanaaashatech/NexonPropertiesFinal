@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Property</h4>
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

                    <!-- Property update form -->
                    <form action="{{ route('property.update', $property->id) }}" method="POST" enctype="multipart/form-data"
                        id="propertyForm">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $property->title) }}" required>
                        </div>

                        <!-- Description -->
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $property->description) }}</textarea>
                        </div>

                        <!-- Category -->
                    <div class="form-group mb-3">
                        <label for="category_id">Category</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $property->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sub Category -->
                    <div class="form-group mb-3">
                        <label for="sub_category_id">Sub Category</label>
                        <select class="form-control" id="sub_category_id" name="sub_category_id" required>
                            @foreach($subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}" {{ $property->sub_category_id == $subCategory->id ? 'selected' : '' }}>
                                    {{ $subCategory->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                        <!-- Street -->
                        <div class="form-group mb-3">
                            <label for="street">Street</label>
                            <input type="text" name="street" id="street" class="form-control" value="{{ old('street', $property->street) }}" required>
                        </div>

                        <!-- Suburb -->
                        <div class="form-group mb-3">
                            <label for="suburb">Suburb</label>
                            <input type="text" name="suburb" id="suburb" class="form-control" value="{{ old('suburb', $property->suburb) }}" required>
                        </div>

                        <!-- State -->
                        <div class="form-group mb-3">
                            <label for="state">State</label>
                            <input type="text" name="state" id="state" class="form-control" value="{{ old('state', $property->state) }}" required>
                        </div>

                        <!-- Post Code -->
                        <div class="form-group mb-3">
                            <label for="post_code">Post Code</label>
                            <input type="text" name="post_code" id="post_code" class="form-control" value="{{ old('post_code', $property->post_code) }}" required>
                        </div>

                        <!-- Price -->
                        <div class="form-group mb-3">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $property->price) }}" required>
                        </div>

                        <!-- Price Type -->
                        <div class="form-group mb-3">
                            <label for="price_type">Price Type</label>
                            <select class="form-control" id="price_type" name="price_type" required>
                                <option value="fixed" {{ $property->price_type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="negotiable" {{ $property->price_type == 'negotiable' ? 'selected' : '' }}>Negotiable</option>
                                <option value="on_request" {{ $property->price_type == 'on_request' ? 'selected' : '' }}>On Request</option>
                            </select>
                        </div>

                        <!-- Bedrooms -->
                        <div class="form-group mb-3">
                            <label for="bedrooms">Bedrooms</label>
                            <input type="number" name="bedrooms" id="bedrooms" class="form-control" value="{{ old('bedrooms', $property->bedrooms) }}" required>
                        </div>

                        <!-- Bathrooms -->
                        <div class="form-group mb-3">
                            <label for="bathrooms">Bathrooms</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="form-control" value="{{ old('bathrooms', $property->bathrooms) }}" required>
                        </div>

                        <!-- Area -->
                        <div class="form-group mb-3">
                            <label for="area">Area (sq ft)</label>
                            <input type="number" name="area" id="area" class="form-control" value="{{ old('area', $property->area) }}" required>
                        </div>

                        <!-- Availability Status -->
                        <div class="form-group mb-3">
                            <label for="availability_status">Availability Status</label>
                            <select name="availability_status" id="availability_status" class="form-control" required>
                                <option value="available" {{ $property->availability_status == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="sold" {{ $property->availability_status == 'sold' ? 'selected' : '' }}>Sold</option>
                                <option value="rental" {{ $property->availability_status == 'rental' ? 'selected' : '' }}>Rental</option>
                            </select>
                        </div>

                        <!-- Main Image Upload with Cropper.js -->
                        <div class="form-group mb-3">
                            <label for="main_image">Upload New Image</label>
                            <input type="file" id="main_image" class="form-control" accept="image/*">
                        </div>

                        <!-- Hidden Inputs for Base64 Image -->
                        <input type="hidden" name="main_image[]" id="croppedImage">
                        <input type="hidden" name="cropData" id="cropData">

                        <!-- Cropped Image Preview -->
                        <div class="form-group mb-3" id="cropped-preview-container" style="display: none;">
                            <label>Cropped Image Preview:</label>
                            <img id="cropped-image-preview" style="max-width: 100%; max-height: 200px; display: block;">
                        </div>
                        <div class="form-group mb-3">
                            <label for="other_images">Other Images</label>
                            <input type="file" id="other_images" class="form-control" name="other_images[]" multiple>
                        </div>
                        <!-- Other Images Preview -->
                        <div class="form-group mb-3" id="other-images-preview-container" style="display: none;">
                            <label>Selected Other Images Preview:</label>
                            <div id="other-images-preview" style="display: flex; flex-wrap: wrap;"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <input type="radio" name="status" id="status_active" value="1" class="form-check-input" 
                                       {{ old('status', $property->status) == '1' ? 'checked' : '' }} required>
                                <label for="status_active" class="form-check-label">Active</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="status" id="status_inactive" value="0" class="form-check-input" 
                                       {{ old('status', $property->status) == '0' ? 'checked' : '' }} required>
                                <label for="status_inactive" class="form-check-label">Inactive</label>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="googlemap">Google Map</label>
                            <input type="text" name="googlemap" id="googlemap" class="form-control" value="{{ old('googlemap', $property->googlemap) }}" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Property</button>
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
                <img id="image-preview" style="max-width: 100%; max-height: 150%; display: none;">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<script>
    let cropper;
    let currentFile;

    // Image file input change event
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

    // jQuery Validation
    $(document).ready(function () {
        $('#propertyForm').validate({
            rules: {
                title: { required: true },
                description: { required: true },
                category_id: { required: true },
                sub_category_id: { required: true },
                street: { required: true },
                suburb: { required: true },
                state: { required: true },
                post_code: { required: true },
                price: { required: true, number: true },
                price_type: { required: true },
                bedrooms: { required: true, number: true },
                bathrooms: { required: true, number: true },
                area: { required: true, number: true },
                availability_status: { required: true }
            },
            messages: {
                title: { required: "The title field is required." },
                description: { required: "The description field is required." },
                category_id: { required: "Please select a category." },
                sub_category_id: { required: "Please select a subcategory." },
                street: { required: "The street field is required." },
                suburb: { required: "The suburb field is required." },
                state: { required: "The state field is required." },
                post_code: { required: "The post code field is required." },
                price: { required: "The price field is required.", number: "The price must be a number." },
                price_type: { required: "The price type field is required." },
                bedrooms: { required: "The bedrooms field is required.", number: "The bedrooms must be a number." },
                bathrooms: { required: "The bathrooms field is required.", number: "The bathrooms must be a number." },
                area: { required: "The area field is required.", number: "The area must be a number." },
                availability_status: { required: "The availability status field is required." }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        // Show toast message after form submission
        if (document.querySelector('.toast')) {
            const toast = new bootstrap.Toast(document.querySelector('.toast'));
            toast.show();
        }
    });
    //For dynamic loading subcategories
    
    document.getElementById('category_id').addEventListener('change', function () {
        const categoryId = this.value;
        const subCategorySelect = document.getElementById('sub_category_id');
        
        // Clear existing options
        subCategorySelect.innerHTML = '<option value="">Select Sub Category</option>';

        if (categoryId) {
            fetch(`{{ url('/subcategories') }}/${categoryId}`)
                .then(response => response.json())
                .then(subcategories => {
                    subcategories.forEach(subcategory => {
                        const option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.title;
                        subCategorySelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching subcategories:', error));
        }
    });
</script>
</script>
@endsection