
{{--
<section class="container-fluid landproperties py-5">
    <div class="container">
        <div class="d-flex flex-column title pb-2">
            <div class="xs-text1 dashline text-center">Trusted Real Estate Care</div>
            <div class="lg-text text-center">Find sales Properties</div>
            <div class="row city-container gap-4 py-2">

                <!-- Display Suburbs and Their Counts -->
                @foreach ($suburbs as $suburb)
                <div class="city-detail rounded m-0 p-0">
                    <div class="city-description d-flex flex-column justify-content-end align-items-center">
                        <p class="md-text1 m-0">{{ $suburb['suburb'] }}</p>
                        <p class="sm-text1">{{ $suburb['count'] }} properties</p>
                    </div>
                </div>
                @endforeach

                <!-- Display Properties -->
                $properties = \App\Models\Property::latest()->take(4)->get(); 
                @foreach ($propertie as $property)
                <div class="city-detail rounded m-0 p-0"> 
                    @php
                        $mainImages = !empty($property->main_image) ? json_decode($property->main_image, true) : [];
                        $mainImage = !empty($mainImages) ? asset('' . $mainImages[0]) : asset('images/default-placeholder.png');
                    @endphp
                    <img src="{{ $mainImage }}" alt="" class="cityimage rounded m-0 p-0">
                    <div class="city-description d-flex flex-column justify-content-end align-items-center">
                        <p class="md-text1 m-0">place</p>
                        {{-- <p class="sm-text1">{{$subPropertyCount}}</p> --}}
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>

--}}




<section class="container-fluid landproperties py-5">
    <div class="container">
        <div class=" d-flex flex-column title pb-2  ">
            <div class="xs-text1 dashline text-center">Trusted Real Estate Care</div>
            <div class="lg-text text-center">Find sales Properties</div>
            <div class="row city-container gap-4 py-2 ">
            @php
    $properties = \App\Models\Property::latest()->take(4)->get(); 

@endphp
                @foreach ( $properties as $property)
                                <div class="city-detail rounded m-0 p-0 ">
                                    @php
                                        $mainImages = !empty($property->main_image) ? json_decode($property->main_image, true) : [];
                                        $mainImage = !empty($mainImages) ? asset('' . $mainImages[0]) : asset('images/default-placeholder.png');
                                     @endphp
                                    <img src="{{ $mainImage }}" alt="" srcset="" class="  cityimage rounded m-0 p-0">
                                    <div class="city-description d-flex flex-column  justify-content-end align-items-center">
                                        <p class="md-text1 m-0">place</p>
                                        <p class="sm-text1">ppp</p>
                                    </div>
                                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
