<section class="container-fluid landproperties py-5">
    <div class="container">
        <div class="d-flex flex-column title pb-2">
            <div class="xs-text1 dashline text-center">Trusted Real Estate Care</div>
            <div class="lg-text text-center">Find Sales Properties</div>
            <div class="row city-container gap-4 py-2">
                @php
                    $properties = \App\Models\Property::latest()->take(4)->get(); 
                @endphp
                @foreach ($properties as $property)
                    <div class="city-detail rounded m-0 p-0">
                        <div class="cityimage rounded m-0 p-0"></div>
                        <div class="city-description d-flex flex-column justify-content-end align-items-center">
                            <p class="md-text1 m-0">{{ $property->location }}</p>
                            <p class="sm-text1">{{ $property->sub_property_count }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
