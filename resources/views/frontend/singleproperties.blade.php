@extends("frontend.layouts.master")
@section("content")
<section class="container-fluid singleprojectpage">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row py-2">
                    <!-- Main Property Image -->
                    <div class="col-md-8">
                        @php
                            $mainImages = !empty($properties->main_image) ? json_decode($properties->main_image, true) : [];
                            $mainImage = !empty($mainImages) ? asset($mainImages[0]) : asset('images/default-placeholder.png');
                        @endphp
                        <img src="{{ $mainImage }}" alt="Property Image" class="imagecontroller imagecontrollerheight rounded">
                    
                        <div class="review-addtofavourite d-flex gap-1 mx-1">
                            <span class="btn-buttonyellow favourite" data-property-id="{{ $properties->id }}">Add to favourite</span>
                            <span class="btn-buttongreen" onclick="openReviewfun()">Review</span>
                        </div>
                    </div>
                        
                    <script>
                        document.querySelector('.favourite').addEventListener('click', function () {
    var propertyId = this.getAttribute('data-property-id');

    // Perform the AJAX request to store favorites
    $.ajax({
        url: '{{ route("favorites.store") }}', 
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            properties_id: propertyId
        },
        success: function (response) {
            if (response.status === 'success') {
                // Update the favorite count in the navbar
                let counterElement = document.querySelector('.counter');
                if (counterElement) {
                    counterElement.textContent = response.count;
                    localStorage.setItem('favoriteCount', response.count);
                }
                alert(response.message);
            } else if (response.status === 'already_added') {
                alert('Already added to favorites');
            }
        },
        error: function (xhr) {
            alert('An error occurred while processing your request');
        }
    });
});

                    </script>
                        
                    
                    <!-- Property Images -->
                    @php
                        $limitedImages = array_slice($otherImages, 0, 6);
                    @endphp
                    <div class="col-md-4">
                        <div class="row">
                            @foreach ($limitedImages as $image)
                                <div class="col-md-6 p-1 px-2">
                                    <img src="{{ asset($image) }}" alt="Property Image"
                                        class="property-image property-imageheight rounded">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Property Details -->
                    <div class="col-md-8 d-flex justify-content-between pt-3 ">
                        <div class="flex">
                            <h3 class="md-text">{{ $properties->title }}</h3>
                            <h4 class="sm-text highlight">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>{{ $properties->state }}-{{ $properties->suburb }}-{{ $properties->street }}</span>
                            </h4>
                        </div>
                        <div class="d-flex py-2">
                            <div class="btn-buttonxs btn-buttonxsgreen mx-1">{{ $properties->status }}</div>
                            <div class="btn-buttonxs btn-buttonxsgreen">{{ $properties->availability_status }}</div>
                        </div>
                    </div>
                    <!-- Overview and Description -->
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="description-body">
                                    <h3 class="md-text greenhighlight">Overview</h3>
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <div>
                                            <h3 class="sm-text des-text">Update</h3>
                                            <h2 class="sm-text">{{ $properties->update_time }}</h2>
                                        </div>
                                        <div>
                                            <h3 class="sm-text des-text">House Type</h3>
                                            <h2 class="sm-text">Residential</h2>
                                        </div>
                                        <div>
                                            <h3 class="sm-text des-text">Bedroom</h3>
                                            <h2 class="sm-text">{{ $properties->bedrooms }}</h2>
                                        </div>
                                        <div>
                                            <h3 class="sm-text des-text">Bathroom</h3>
                                            <h2 class="sm-text">{{ $properties->bathrooms }}</h2>
                                        </div>
                                        <div>
                                            <h3 class="sm-text des-text">Size</h3>
                                            <h2 class="sm-text">{{ $properties->area }}</h2>
                                        </div>
                                        <div>
                                            <h3 class="sm-text des-text">Price</h3>
                                            <h2 class="sm-text">{{ $properties->price }}</h2>
                                        </div>
                                    </div>
                                </div>
                                <!-- Property Description -->
                                <div class="description-body">
                                    <h3 class="md-text greenhighlight">Description</h3>
                                    <p class="sm-text">{{ $properties->description }}</p>
                                </div>
                                <!-- Additional Information -->
                                <div class="description-body">
                                    <h3 class="md-text greenhighlight">More Information if Any</h3>
                                    <p class="sm-text">{{ $properties->description }}</p>
                                </div>



                                <div class="review mx-2">
                                    <h1 class="admire rounded p-3 lg-text1 greenhighlight">We admire your review</h1>
                                    <div class="row gap-2">
                                        @forelse($acceptedReviews as $review)
                                            <div class="show-review col-md-12 m-1 p-3">
                                                <p class="p-0 m-0 md-text">{{ e($review->name) }}</p>
                                                <p class="p-0 m-0">
                                                    @for($i = 0; $i < $review->ratings; $i++)
                                                        <i class="fa-solid fa-star"></i>
                                                    @endfor
                                                </p>
                                                <p class="p-0 m-0 extra-text">{{ e($review->reviews) }}</p>
                                            </div>
                                        @empty
                                            <p class="col-md-12 m-1 p-3">No reviews yet for this property.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                                 <!-- Sidebar Details-->
                                
                          
                            <div class="col-md-4">
                                <div class="description-body">
                                    <h3 class="md-text greenhighlight">Nexon Detail Center</h3>
                                    <form action="{{ route('contact.store') }}" method="POST">
                                        @csrf
                                        <div class="d-flex flex-column gap-2">
                                            @auth
                                                <!-- If the user is logged in, display a message box without input fields -->
                                                <p class="text-muted">Any queries, {{ Auth::user()->name }}?
                                                    ({{ Auth::user()->email }})</p>
                                                <textarea name="message" class="textarea" placeholder="Your Message"
                                                    required></textarea>
                                                <button type="submit"
                                                    class="btn-buttongreen btn-buttonygreenlarge mx-2">Send Message</button>
                                            @else
                                                <!-- If the user is a guest, show the form fields -->
                                                <input type="text" name="person_name" class="input"
                                                    placeholder="Person Name" required>
                                                <input type="email" name="email" class="input my-2" placeholder="Email"
                                                    required>
                                                <textarea name="message" class="textarea" placeholder="Your Message"
                                                    required></textarea>
                                                <button type="submit"
                                                    class="btn-buttongreen btn-buttonygreenlarge mx-2">Submit</button>
                                            @endauth
                                        </div>
                                    </form>
                                </div>
                                <div class="paddingbox nobackground description-body">
                                    <h2 class="md-text">Feature List</h2>
                                    <div class="featurelist-body">
                                        @foreach ($relatedProperties as $property)
                                                                                <a class="featurelist-content d-flex py-1"
                                                                                    href="{{ route('singleproperties', ['id' => $property->id]) }}">
                                                                                    @php
                                                                                        $mainImages = !empty($property->main_image) ? json_decode($property->main_image, true) : [];
                                                                                        $mainImage = !empty($mainImages) ? asset($mainImages[0]) : asset('images/default-placeholder.png');
                                                                                    @endphp
                                                                                    <img src="{{ $mainImage }}" alt="Property Image" class="feature-smallimg"
                                                                                        data-src="holder.js/200x250?theme=thumb">
                                                                                    <div class="featurlist-description mx-3">
                                                                                        <h3 class="sm-text">{{ $property->title }}</h3>
                                                                                        <p class="sm-text highlight">{{ $property->price }}</p>
                                                                                    </div>
                                                                                </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <div class="container-fluid m-0 p-0">
        @if(Auth::check())
            <div class="review-form" style="display: none;">
                <div class="d-flex row justify-content-center">
                    <div class="col-md-5 p-5 review-form-detail" id="getviewform">
                        <i class="fa-solid fa-circle-xmark" onclick="closeFormFun()"></i>
                        <h2 class="md-text1">Rating</h2>
                        <div class="star-rating">
                            <i class="fa-solid fa-star" data-rating="1"></i>
                            <i class="fa-solid fa-star" data-rating="2"></i>
                            <i class="fa-solid fa-star" data-rating="3"></i>
                            <i class="fa-solid fa-star" data-rating="4"></i>
                            <i class="fa-solid fa-star" data-rating="5"></i>
                        </div>
                        <form id="reviewForm" action="{{ route('review.store') }}" method="POST">
                            @csrf
                            <input type="text" name="name" class="input" value="{{ Auth::user()->name }}" required readonly>
                            <input type="email" name="email" class="input my-2" value="{{ Auth::user()->email }}" required readonly>
                            <textarea name="reviews" class="input my-2" placeholder="Your Message" required></textarea>
                            <input type="hidden" name="property_id" value="{{ $properties->id }}">
                            <input type="hidden" name="ratings" id="ratings-input" value="0">
                            <input type="hidden" name="status" value="pending">
                            <button type="submit" class="btn-buttonyellow mx-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="login-message overlay" style="display: none;">
                <div class="popup-content">
                    <i class="fa-solid fa-circle-xmark popup-close" onclick="closeLoginPopup()"></i>
                    <h2>Please Login First</h2>
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                </div>
            </div>
        @endif
    </div>
    
    <script>
       

    // For Reviews and Ratings

        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-rating .fa-star');
            const ratingInput = document.getElementById('ratings-input');
            let currentRating = 0;
    
            stars.forEach(star => {
                star.addEventListener('mouseover', function() {
                    const rating = this.getAttribute('data-rating');
                    highlightStars(rating);
                });
    
                star.addEventListener('mouseout', function() {
                    highlightStars(currentRating);
                });
    
                star.addEventListener('click', function() {
                    currentRating = this.getAttribute('data-rating');
                    ratingInput.value = currentRating;
                    highlightStars(currentRating);
                });
            });
    
            function highlightStars(rating) {
                stars.forEach(star => {
                    if (star.getAttribute('data-rating') <= rating) {
                        star.classList.add('active');
                    } else {
                        star.classList.remove('active');
                    }
                });
            }
    
            // Prevent form submission if no rating is selected
            document.getElementById('reviewForm')?.addEventListener('submit', function(e) {
                if (ratingInput.value === '0') {
                    e.preventDefault();
                    alert('Please select a rating before submitting.');
                }
            });
        });
    
        function openReviewfun() {
            @if(Auth::check())
                const reviewForm = document.querySelector(".review-form");
                reviewForm.style.display = reviewForm.style.display === "none" ? "block" : "none";
            @else
                const loginMessage = document.querySelector(".login-message");
                loginMessage.style.display = "block";
            @endif
        }
    
        function closeFormFun() {
            document.querySelector(".review-form").style.display = "none";
        }
    
        function closeLoginPopup() {
            document.querySelector(".login-message").style.display = "none";
        }
    </script>
    
    <style>
        .star-rating .fa-star {
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }
        .star-rating .fa-star.active {
            color: #ffd700;
        }
        .login-message {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            position: relative;
        }
        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js">
    
    // For Add to Favorites.


    $(document).ready(function() {
        $('.favourite').on('click', function() {
            let propertyId = $(this).data('property-id');
            
            $.ajax({
                url: '{{ route("favorites.store") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    properties_id: propertyId,
                },
                success: function(response) {
                    if(response.message) {
                        alert(response.message); // Success message
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred while adding to favorites.';
                    
                    // Check if specific error message is returned
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    
                    alert(errorMessage); // Error message
                }
            });
        });
    });
</script> --}}

 @endsection