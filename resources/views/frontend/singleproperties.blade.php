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
                    </div>
                    
                    <!-- Property Images -->
                    <div class="col-md-4">
                        <div class="row">
                            @foreach ($otherImages as $image)
                                <div class="col-md-6 p-1 px-2">
                                    <img src="{{ asset($image) }}" alt="Property Image" class="property-image property-imageheight rounded">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Property Details -->
                <div class="col-md-12">
                    <div class="d-flex py-2">
                        <div class="btn-buttonxs btn-buttonxsgreen mx-1">{{ $properties->status }}</div>
                        <div class="btn-buttonxs btn-buttonxsgreen">{{ $properties->availability_status }}</div>
                    </div>
                    <h3 class="md-text">{{ $properties->title }}</h3>
                    <h4 class="sm-text">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>{{ $properties->state }}-{{ $properties->suburb }}-{{ $properties->street }}</span>
                    </h4>
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
                        </div>

                        <!-- Sidebar Details -->
                        <div class="col-md-4">
                            <div class="description-body">
                                <h3 class="md-text greenhighlight">Nexon Detail Center</h3>
                                <div class="d-flex flex-column gap-2">
                                    <input type="text" name="person_name" class="input" placeholder="Person Name">
                                    <input type="text" name="contact_no" class="input my-2" placeholder="Contact No.">
                                    <textarea name="message" class="textarea" placeholder="Your Message"></textarea>
                                    <button class="btn-buttongreen btn-buttonygreenlarge mx-2">Search</button>
                                </div>
                            </div>

                            <!-- Related Properties -->
                            <div class="paddingbox nobackground description-body">
                                <h2 class="md-text">Feature List</h2>
                                <div class="featurelist-body">
                                    @foreach ($relatedProperties as $property)
                                        <a class="featurelist-content d-flex py-1" href="{{ route('singleproperties', ['id' => $property->id]) }}">
                                            @php
                                                $mainImages = !empty($property->main_image) ? json_decode($property->main_image, true) : [];
                                                $mainImage = !empty($mainImages) ? asset($mainImages[0]) : asset('images/default-placeholder.png');
                                            @endphp
                                            <img src="{{ $mainImage }}" alt="Property Image" class="feature-smallimg" data-src="holder.js/200x250?theme=thumb">
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
</section>
@endsection
