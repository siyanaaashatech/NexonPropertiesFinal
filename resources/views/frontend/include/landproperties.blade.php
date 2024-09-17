<section class="container-fluid">
    <div class="container">
        <div class=" d-flex flex-column justify-content-center align-items-center title pb-2  ">
            <div class="xs-text1 dashline">Trusted Real Estate Care</div>
            <div class="lg-text">Find sales Properties</div>
            <div class="row">
                @foreach ($properties as $property)
                    <div class="col-md-4">
                        <img src="{{asset('image/abou1.png')}}" alt="" class="col-md-12 rounded">
                        <p class="md-text">{{$property->title}}</p>
                        <h4 class="sm-text">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>{{ $property->state }}-{{ $property->suburb }}-{{ $property->street }}</span>
                        </h4>



                    </div>

                @endforeach





            </div>

        </div>


    </div>



</section>