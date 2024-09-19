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

                        <img src="{{ $mainImage }}" alt="Property Image"
                            class="imagecontroller imagecontrollerheight rounded">
                        <div class="review-addtofavourite d-flex gap-1 mx-1">
                            <span class=" btn-buttonyellow favourite ">Add to favourite</span>
                            <span class="btn-buttongreen " onclick="openReviewfun()">Review</span>
                        </div>
                    </div>

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
                                    <h1 class="admire rounded p-3 lg-text1 greenhighlight">we admire you review</h1>
                                    <div class="row gap-2">
                                        <div class="show-review col-md-12 m-1 p-3">
                                                <p class="p-0 m-0 md-text">name</p>
                                                <p class="p-0 m-0"><i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </p>
                                            <p class="p-0 m-0 extra-text">description ssssss sss ewr wew23q eq32f ssssssc  hrllo i am fine i ksssss dss sss sssdd ssssssss eeeeeeeeeeeeev eeee</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <!-- Sidebar Details -->
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
    <style>
        .review-form {
            display: none;
        }
    </style>
    <div class="container-fluid m-0 p-0">
        <div class="review-form">
            <div class="d-flex row  justify-content-center">
                <div class="col-md-5 p-5 review-form-detail" id="getviewform">
                    <i class="fa-solid fa-circle-xmark" onclick="closeFormFun()"></i>
                    <h2 class="md-text1">Rating</h2>
                    <h2 class="md-text1 rating ">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>

                    </h2>
                    <input type="text" name="person_name" class="input" placeholder="Person Name" required>
                    <input type="email" name="email" class="input my-2" placeholder="Email" required>
                    <textarea name="message" class="textarea" placeholder="Your Message" required></textarea>
                    <button type="submit" class="btn-buttonyellow  mx-2">Submit</button>
                </div>
            </div>


        </div>
    </div>
</section>


<script>

    function openReviewfun() {
        const getviewform = document.querySelector(".review-form")
        if (getviewform.style.display === "none") {
            getviewform.style.display = "block";

        }
        else {
            getviewform.style.display = "none";

        }

    }
    function closeFormFun() {
        const getviewform = document.querySelector(".review-form")
        getviewform.style.display = "none";

    }



</script>
@endsection