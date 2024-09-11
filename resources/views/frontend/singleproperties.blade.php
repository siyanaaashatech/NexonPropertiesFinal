@extends("frontend.layouts.master")
@section("content")




<section class="container-fluid singleprojectpage">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row py-2">
                    <div class="col-md-8  ">
                        @php
                            $mainImages = !empty($properties->main_image) ? json_decode($properties->main_image, true) : [];
                            $mainImage = !empty($mainImages) ? asset('' . $mainImages[0]) : asset('images/default-placeholder.png');
                         @endphp

                        <img src="{{ $mainImage }}" alt="Property Image"
                            class="imagecontroller imagecontrollerheight rounded ">

                    </div>
                    <!-- Property Images -->
                    <div class="col-md-4">
                    <div class="row">
                            @foreach ($otherImages as $image)
                                <div class="col-md-6 p-1 px-2">
                                    <img src="{{ asset('' . $image) }}" alt="Property Image" class="property-image property-imageheight rounded">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="d-flex py-2">
                        <div class="btn-buttonxs  btn-buttonxsgreen mx-1">{{$properties->status}}</div>
                        <div class="btn-buttonxs btn-buttonxsgreen">{{$properties->availability_status}} </div>
                    </div>
                    <h3 class="md-text">{{$properties->title}}</h3>
                    <h4 class="sm-text"><i class="fa-solid fa-location-dot"></i>
                        <span>{{$properties->state}}-{{$properties->suburb}}-{{$properties->street}}</span>
                    </h4>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="description-body">
                                <h3 class="md-text greenhighlight">overview</h3>
                                <div class="d-flex justify-content-between flex-wrap">
                                    <div class=" ">
                                        <h3 class="sm-text des-text">update</h3>
                                        <h2 class="sm-text">{{$properties->update_time}}</h2>
                                    </div>
                                    <div class=" ">
                                        <h3 class="sm-text des-text">house type</h3>
                                        <h2 class="sm-text">residential</h2>
                                    </div>
                                    <div class=" ">
                                        <h3 class="sm-text des-text">bedroom</h3>
                                        <h2 class="sm-text">{{$properties->bedrooms}}</h2>
                                    </div>
                                    <div class=" ">
                                        <h3 class="sm-text des-text">bathroom</h3>
                                        <h2 class="sm-text">{{$properties->bathrooms}}</h2>
                                    </div>
                                    <div class=" ">
                                        <h3 class="sm-text des-text">size</h3>
                                        <h2 class="sm-text">{{$properties->area}}</h2>
                                    </div>
                                    <div class=" ">
                                        <h3 class="sm-text des-text">Price</h3>
                                        <h2 class="sm-text">{{$properties->price}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="description-body">
                                <h3 class="md-text greenhighlight">description</h3>
                                <p class="sm-text">
                                    {{$properties->description}}
                                </p>

                            </div>
                            <div class="description-body">
                                <h3 class="md-text greenhighlight">more information if any</h3>
                                <p class="sm-text">
                                    {{$properties->description}}
                                </p>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="description-body">
                                <h3 class="md-text greenhighlight">nexon detail center</h3>
                                <div class="d-flex flex-column gap-2">
                                    <input type="text" name="" id="" class="input" placeholder="Person name" />
                                    <input type="text" name="" id="" class="input" placeholder="Contact NO."
                                        class="my-2" />
                                    <textarea name="" id="" class="textarea"></textarea>
                                    <button class="btn-buttongreen btn-buttonygreenlarge mx-2">Search</button>
                                </div>
                            </div>
                            <div class="paddingbox nobackground description-body">
                                <h2 class="md-text">feature list</h2>
                                <div class="featurelist-body">
                                    @foreach ($relatedProperties as $property)
                                                                        <a class="featurelist-content d-flex py-1"
                                                                            href="{{route('singleproperties', ['id' => $property->id])}}">



                                                                            @php
                                                                                $mainImages = !empty($property->main_image) ? json_decode($property->main_image, true) : [];
                                                                                $mainImage = !empty($mainImages) ? asset('' . $mainImages[0]) : asset('images/default-placeholder.png');
                                                                             @endphp
                                                                            <img src="{{ $mainImage }}" alt="Property Image" class="feature-smallimg"
                                                                                data-src="holder.js/200x250?theme=thumb" />

                                                                            <div class="featurlist-description mx-3">
                                                                                <h3 class="sm-text">{{$property->title}}</h3>
                                                                                <p class="sm-text highlight"> {{$property->price}}</p>
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
</section>
@endsection