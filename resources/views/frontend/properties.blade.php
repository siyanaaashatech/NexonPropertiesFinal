@extends("frontend.layouts.master")
@section("content")


<section class="container-fluid">
    <div class="row">
        <div class="col-md-12 p-0">
            <div class="carousel-inner mb-3">
                <div class="row d-flex">
                    <div
                        class="col-md-12 text-center d-flex flex-column justify-content-center align-items-center mb-2 ">
                        <img src="{{ asset('image/house3.png') }}" alt="" srcset=""
                            class="imagecontroller imagecontrollerheight">
                        <div class="flex bannercontentheight">
                            <div class="bannercontentinnerheight ">
                                <h4 class="lg-text1">properties</h4>
                                <h5 class="md-text1">home <i class="fa-solid fa-angle-right "></i>
                                    <span class="highlight">properties</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>


{{-- form --}}
<form action="{{ route('frontend.searching') }}" method="GET" class="container-fluid py-5 propertiesfinder">
    <div class="container">
        <h1 class="md-text1 text-center searchhide" onclick="funsearchingon()">
            <i class="fa-brands fa-searchengin customicons"></i> Find your properties
        </h1>
        <div class="justify-content-center align-items-center gap-2 flex-wrap hiddenform" id="hiddenform">
            <div class="d-flex flex-column col-md-3">
                <label for="" class="sm-text1 des-text">Listing type</label>
                <select type="text" class="input bannerinput" name="region" placeholder="Regions"
                    value="{{ request('region') }}">
                    <option value="" disabled selected>Select Category</option>
                    @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ request('list_type') == $category->id ? 'selected' : '' }}>
              {{ $category->title }}
              </option>
            @endforeach
                    </select>
            </div>


            <div class="d-flex flex-column col-md-3">
                <label for="" class="sm-text1 des-text">Properties type</label>
                <select type="text" class="input bannerinput" name="region" placeholder="Regions"
                    value="{{ request('region') }}">
                    @foreach($subcategories as $subcategory)
              <option value="{{ $subcategory->id }}" data-category-id="{{ $subcategory->category_id }}"
              {{ request('property_type') == $subcategory->id ? 'selected' : '' }}>
              {{ $subcategory->title }}
              </option>
            @endforeach</option>
                    </select>
            </div>

            <div class="d-flex flex-column col-md-3">
                <label for="" class="sm-text1 des-text">Location</label>
                <select type="text" class="input bannerinput" name="region" placeholder="Regions"
                    value="{{ request('region') }}">
                    <option value="1">States</option>
                    <option value="">
                      @foreach($properties as $property)
              @if(!empty($property->state))
          <option value="{{ $property->state }}" {{ request('state') == $property->state ? 'selected' : '' }}>
          {{ $property->state }}
          </option>
        @endif
            @endforeach</option>
                    </select>
            </div>

            <div class="d-flex flex-column col-md-3">
                <label for="" class="sm-text1 des-text">Location</label>
                <select type="text" class="input bannerinput" name="region" placeholder="Regions"
                    value="{{ request('region') }}">
                    <option value="1">regions</option>
                    <option value="2">Region 1</option>
                    <option value="3">Region 2</option>
                    </select>
            </div>

            <div class="d-flex flex-column col-md-3">
                <label for="" class="md-text1 des-text">Price</label>
                <input type="text" class="input bannerinput" name="location" placeholder="Keyword"
                    value="{{ request('location') }}">
            </div>

            <div class="d-flex flex-column col-md-3">
                <label for="" class="sm-text1 des-text">Search</label>
                <button type="submit" class="btn-buttonyellow btn-buttonyellowlg">Find properties</button>
            </div>

        </div>
    </div>
</form>




{{--

<!-- project page-->
<!-- hero section -->
<section class="container-fluid">
    <div class="row">
        <div class="col-md-12 p-0">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner mb-3">
                    <!-- First Carousel Item -->
                    <div class="carousel-item active">
                        <div class="row d-flex">
                            <div
                                class="col-md-12 text-center d-flex flex-column justify-content-center align-items-center mb-2 ">
                                <img src="{{ asset('image/house1.png') }}" alt="" srcset="" class="imagecontroller">
                                <div class="flex bannercontent">
                                    <div class="bannercontentinner">
                                        <p class="sm-text1 mb-3 text-center forhidden">More than <span
                                                class="highlight">1000+</span> houses
                                            available for
                                            sale &
                                            rent in the country</p>
                                        <h4 class="lg-text1 mb-4">Find Your Dream Home</h4>
                                        <div class="d-flex justify-content-center mb-1">
                                            <div class="btn-buttonyellow btn-buttonyellowsmall">Buy</div>
                                            <div class="btn-buttongreen mx-2">Rent</div>
                                        </div>
                                        <div
                                            class="formsection d-flex flex-column justify-content-center align-items-center py-md-3 py-2 gap-2 col-md-10 px-4 mx-md-4">
                                            <div class="d-flex flex-wrap  gap-md-3">
                                                <input type="text" class="input bannerinput" placeholder="List type">
                                                <input type="text" class="input bannerinput"
                                                    placeholder="property type">
                                                <input type="text" class="input bannerinput" placeholder="Location">
                                                <input type="text" class="input bannerinput" placeholder="Price">
                                                <input type="text" class="input bannerinput" placeholder="Bedroom">
                                                <button class="btn-buttongreen bannerinput ">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>


</section>
--}}

<!-- multiple properties section -->
<section class="container-fluid multipost mb-3 pb-4">
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="property-container d-flex justify-content-center align-self-center gap-3 flex-wrap">
                    <div class="btn-buttongreen"> <i class="fa-solid fa-house customicons customiconssmall"></i> sale
                    </div>
                    <div class="btn-buttongreen"> <i class="fa-solid fa-house customicons customiconssmall"></i> Condos
                    </div>
                    <div class="btn-buttongreen "> <i class="fa-solid fa-house customicons customiconssmall"></i> sale
                    </div>
                    <div class="btn-buttongreen "> <i class="fa-solid fa-house customicons customiconssmall"></i> Condos
                    </div>
                    <div class="btn-buttongreen "> <i class="fa-solid fa-house customicons customiconssmall"></i> sale
                    </div>
                </div>
            </div>
            <div class="col-md-12 py-3">
                <div class="row">
                    @foreach ($properties as $property)
                                        <a class="col-md-4 my-2" href="{{route('singleproperties', ['id' => $property->id])}}">
                                            <div class="card">
                                                @php
                                                    $mainImages = !empty($property->main_image) ? json_decode($property->main_image, true) : [];
                                                    $mainImage = !empty($mainImages) ? asset('' . $mainImages[0]) : asset('images/default-placeholder.png');
                                                 @endphp
                                                <img src="{{ $mainImage }}" alt="Property Image" class="p-2">
                                                <div class="sell_rent_button d-flex justify-content-between ">
                                                    <div class="btn-buttonxs btn-buttonxsyellow ">{{$property->status}}</div>
                                                    <div class="btn-buttonxs btn-buttonxsgreen mx-1">{{$property->availability_status}}
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="md-text">{{strlen($property->title)>28 ? substr($property->title ,0 ,28). "...":$property->title }}</h5>
                                                    <div class=" d-flex gap-3 flex-wrap ">
                                                        <h2 class="sm-text"><span class="mx-1">{{ $property->bedrooms}}</span> bedroom</h2>
                                                        <h2 class="sm-text"><span class="mx-1">{{ $property->bathrooms}}</span>bathroom</h2>
                                                        <h2 class="sm-text"><span class="mx-1">{{ $property->price}}</span>area</h2>
                                                    </div>
                                                    <div class="price-person ">
                                                        <div class="d-flex justify-content-between align-content-center">
                                                            <div class=" sm-text"> <span class="md-text"> ${{ $property->price}}
                                                                    /</span>{{ $property->rental_period}} </div>
                                                            <img src="{{asset('image/blog.png')}}" alt="" sizes="" srcset=""
                                                                class="feature-smallimg feature-smallimgdup">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>



<!-- nextpage section -->
<section class="container-fluid ">
    <div class="container">
        <div class="row  nextpage ">



            <ul class="nextui d-flex gap-1 justify-content-center align-content-center flex-wrap">
                <li class="nextli next-button" onclick="changepage(this)"><a href="#" class="md-text1">1</a></li>
                <li class="nextli" onclick="changepage(this)"><a href="#" class="md-text1">2</a></li>
                <li class="nextli" onclick="changepage(this)"><a href="#" class="md-text1">3</a></li>
                <li class="nextli" onclick="changepage(this)"><a href="#" class="md-text1">4</a></li>
                <li class="nextli" onclick="changepage(this)"><a href="#" class="md-text1">5</a></li>
            </ul>





        </div>
    </div>
</section>
@endsection

<style>




</style>


<script>
   function funsearchingon() {
    const hiddenformdata = document.querySelector(".hiddenform");

    // Toggle the display style
    if (hiddenformdata.style.display === "none" || hiddenformdata.style.display === "") {
        hiddenformdata.style.display = "block";
    } else {
        hiddenformdata.style.display = "none";
    }
}


    function changepage(clickedElement) {
    // Remove 'next-button' class from all list items
    const allButtons = document.querySelectorAll('.nextli');
    allButtons.forEach(button => button.classList.remove('next-button'));

    // Add 'next-button' class to the clicked list item
    clickedElement.classList.add('next-button');
}




</script>