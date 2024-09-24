@extends("frontend.layouts.master")
@section("content")

{{--
<section class="container-fluid">
  <div class="row">
    <div class="col-md-12 p-0">
      <div class="carousel-inner mb-3">
        <div class="row d-flex">
          <div class="col-md-12 text-center d-flex flex-column justify-content-center align-items-center mb-2 ">
            <img src="{{ asset('image/house3.png') }}" alt="" srcset="" class="imagecontroller imagecontrollerheight">
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
--}}



<section class="container-fluid">
  <div class="row">
    <div class="col-md-12 p-0">
      <div class="carousel-inner mb-3">
        <div class="row d-flex">
          <div class="col-md-12 text-center d-flex flex-column justify-content-center align-items-center mb-2 ">
            <img src="{{ asset('image/house3.png') }}" alt="" srcset="" class="imagecontroller imagecontrollerheight">
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






<form action="{{ route('frontend.searching') }}" method="GET" class="container-fluid py-5 propertiesfinder">
    <div class="container">
        <h1 class="md-text1 text-center searchhide" onclick="funsearchingon()">
            <i class="fa-brands fa-searchengin customicons"></i> Find your properties
        </h1>
        <div class="justify-content-center align-items-center gap-2 flex-wrap hiddenform" id="hiddenform">
                <div class="d-flex flex-column col-md-3">
                    <label for="" class="sm-text1 des-text">Listing type</label>
                    <select class="input bannerinput" name="category_id" id="category_id">
                        <option value="" disabled selected>Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex flex-column col-md-3">
                    <label for="" class="sm-text1 des-text">Select Category</label>
                  <select class="input bannerinput" name="subcategory_id" id="subcategory_id">
                    <option value="" disabled selected>Select Subcategory</option>
                  </select>
                </div>
                <div class="d-flex flex-column col-md-3">
                    <label for="" class="sm-text1 des-text">Select State</label>
                  <select class="input bannerinput" name="state" id="state">
                    <option value="" disabled selected>Select State</option>
                    @foreach($states as $state)
                      <option value="{{ $state }}">{{ $state }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="d-flex flex-column col-md-3">
                    <label for="" class="sm-text1 des-text">Select Region</label>
                  <select class="input bannerinput" name="suburb" id="suburb">
                    <option value="" disabled selected>Select Region</option>
                  </select>
                </div>
                <div class="d-flex flex-column col-md-3">
                    <label for="" class="sm-text1 des-text">Keyword</label>
                  <input type="text" class="input bannerinput" name="location" placeholder="Keyword"
                  value="{{ request('location') }}">
                </div>
                <span class="sm-text mt-2 whitehighlight advance mx-2" onclick="funOpenadvance()">Advanced ::</span>
            <div class="d-flex flex-column col-md-3">
                <label for="" class="sm-text1 des-text">Search</label>
                <button type="submit" class="btn-buttonyellow btn-buttonyellowlg">Find properties</button>
            </div>

        </div>
    </div>
</form>
<section class="container rounded amenities py-2">
    <div class="row p-3" id="advanceitems">
      <h2 class="md-text greenhighlight mx-2">amenities</h2>
      <!-- Amenity Checkboxes -->
      @foreach($amenities as $amenity)
        <div class="d-flex col-md-2 pt-1">
          <input type="checkbox" name="amenities[]" id="amenity-{{ $amenity->id }}" value="{{ $amenity->id }}"
                 {{ in_array($amenity->id, request('amenities', [])) ? 'checked' : '' }} class="amenity-checkbox">
          <label for="amenity-{{ $amenity->id }}" class="nameofthing">{{ $amenity->title }}</label>
        </div>
      @endforeach
    </div>
  
    <!-- Bedrooms, Bathrooms, Area, and Price Section -->
    <div class="row mx-2 d-flex justify-content-between gap-1">
      <div class="col-md-3">
          <label for="bedrooms" class="sm-text">Bedrooms</label>
          <select name="bedrooms" id="bedrooms" class="input bannerinput">
              <option value="" selected>Beds Any</option>
              @for ($i = 1; $i <= 10; $i++)
                  <option value="{{ $i }}" {{ request('bedrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
              @endfor
          </select>
      </div>
      <div class="col-md-3">
          <label for="bathrooms" class="sm-text">Bathrooms</label>
          <select name="bathrooms" id="bathrooms" class="input bannerinput">
              <option value="" selected>Baths Any</option>
              @for ($i = 1; $i <= 10; $i++)
                  <option value="{{ $i }}" {{ request('bathrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
              @endfor
          </select>
      </div>
      <div class="col-md-3">
          <label for="area-range" class="md-text">Area (sq. ft.)</label>
          <div id="area-slider" class="mt-2"></div>
          <span id="area-range-display" class="sm-text d-block mt-2"></span>
          <input type="hidden" name="min_area" id="min_area">
          <input type="hidden" name="max_area" id="max_area">
      </div>
      <div class="col-md-3">
          <label for="price-range" class="md-text">Price</label>
          <div id="price-slider" class="mt-2 price-slider"></div>
          <span id="price-range-display" class="sm-text d-block mt-2"></span>
          <input type="hidden" name="min_price" id="min_price">
          <input type="hidden" name="max_price" id="max_price">
      </div>
  </div>
  
  </section>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const amenitiesCheckboxes = document.querySelectorAll('.amenity-checkbox');
    const searchForm = document.querySelector('form[action="{{ route('frontend.searching') }}"]');
    
    function updateSearch() {
      const selectedAmenities = Array.from(amenitiesCheckboxes)
        .filter(cb => cb.checked)
        .map(cb => cb.value);
  
      searchForm.querySelectorAll('input[name="amenities[]"]').forEach(input => input.remove());
  
      selectedAmenities.forEach(amenityId => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'amenities[]';
        input.value = amenityId;
        searchForm.appendChild(input);
      });
  
      ['bedrooms', 'bathrooms', 'min_area', 'max_area', 'min_price', 'max_price'].forEach(filterName => {
        const filterElement = document.getElementById(filterName);
        if (filterElement) {
          const filterValue = filterElement.value;
          searchForm.querySelector(`input[name="${filterName}"]`)?.remove();
  
          if (filterValue) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = filterName;
            input.value = filterValue;
            searchForm.appendChild(input);
          }
        }
      });
    }
  
    amenitiesCheckboxes.forEach(checkbox => {
      checkbox.addEventListener('change', updateSearch);
    });
  
    // Attach event listeners to all filters
    ['bedrooms', 'bathrooms', 'min_area', 'max_area', 'min_price', 'max_price'].forEach(filterName => {
      const filterElement = document.getElementById(filterName);
      if (filterElement) {
        filterElement.addEventListener('change', updateSearch);
      }
    });
  
    function funOpenadvance() {
      const advanceItems = document.querySelector(".amenities");
      if (!advanceItems) {
        console.error("Element with class 'amenities' not found.");
        return;
      }
      advanceItems.style.display = advanceItems.style.display === "none" ? "block" : "none";
    }
  
    const advanceSearchButton = document.querySelector('.advance');
    if (advanceSearchButton) {
      advanceSearchButton.addEventListener('click', funOpenadvance);
    }
  
    // Initialize Area Slider
    $("#area-slider").slider({
      range: true,
      min: 0,
      max: 10000,
      values: [0, 10000],
      slide: function(event, ui) {
        updateAreaDisplay(ui.values[0], ui.values[1]);
      },
      change: updateSearch 
    });
  
    function updateAreaDisplay(minArea, maxArea) {
      $("#area-range-display").text(minArea.toLocaleString() + " - " + maxArea.toLocaleString() + " sq. ft.");
      $("#min_area").val(minArea);
      $("#max_area").val(maxArea);
    }
  
    // Initialize the area display
    updateAreaDisplay($("#area-slider").slider("values", 0), $("#area-slider").slider("values", 1));
  
    // Initialize Price Slider
    $("#price-slider").slider({
      range: true,
      min: 0,
      max: 1000000,
      values: [0, 1000000],
      slide: function(event, ui) {
        updatePriceDisplay(ui.values[0], ui.values[1]);
      },
      change: updateSearch // Add this line to trigger updateSearch on slider change
    });
  
    function updatePriceDisplay(minPrice, maxPrice) {
      $("#price-range-display").text("$" + minPrice.toLocaleString() + " - $" + maxPrice.toLocaleString());
      $("#min_price").val(minPrice);
      $("#max_price").val(maxPrice);
    }
  
    // Initialize the price display
    updatePriceDisplay($("#price-slider").slider("values", 0), $("#price-slider").slider("values", 1));
  
    // Update hidden inputs when form is submitted
    searchForm.addEventListener('submit', function(e) {
      updateSearch(); // Ensure all current values are included
    });
  });
  </script>
  

<script>
    $(document).ready(function() {
      $('#category_id').change(function() {
        var categoryId = $(this).val();
        if (categoryId) {
          $.ajax({
            url: '/get-subcategories/' + categoryId,
            type: 'GET',
            success: function(data) {
              $('#subcategory_id').empty();
              $('#subcategory_id').append('<option value="" disabled selected>Select Subcategory</option>');
              $.each(data, function(key, value) {
                $('#subcategory_id').append('<option value="' + value.id + '">' + value.title + '</option>');
              });
            }
          });
        } else {
          $('#subcategory_id').empty();
          $('#subcategory_id').append('<option value="" disabled selected>Select Subcategory</option>');
        }
      });
    
      $('#state').change(function() {
        var state = $(this).val();
        if (state) {
          $.ajax({
            url: '/get-suburbs/' + state,
            type: 'GET',
            success: function(data) {
              $('#suburb').empty();
              $('#suburb').append('<option value="" disabled selected>Select Region</option>');
              $.each(data, function(key, value) {
                $('#suburb').append('<option value="' + value + '">' + value + '</option>');
              });
            }
          });
        } else {
          $('#suburb').empty();
          $('#suburb').append('<option value="" disabled selected>Select Region</option>');
        }
      });
    });
    </script>
   

   

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
              <div class="col-md-12 text-center d-flex flex-column justify-content-center align-items-center mb-2 ">
                <img src="{{ asset('image/house1.png') }}" alt="" srcset="" class="imagecontroller">
                <div class="flex bannercontent">
                  <div class="bannercontentinner">
                    <p class="sm-text1 mb-3 text-center forhidden">More than <span class="highlight">1000+</span> houses
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
                        <input type="text" class="input bannerinput" placeholder="property type">
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
              <h5 class="md-text">
                {{strlen($property->title) > 28 ? substr($property->title, 0, 28) . "..." : $property->title }}</h5>
              <div class=" d-flex gap-3 flex-wrap ">
                <h2 class="sm-text"><span class="mx-1">{{ $property->bedrooms}}</span> bedroom</h2>
                <h2 class="sm-text"><span class="mx-1">{{ $property->bathrooms}}</span>bathroom</h2>
                <h2 class="sm-text"><span class="mx-1">{{ $property->price}}</span>area</h2>
              </div>
              <div class="price-person ">
                <div class="d-flex justify-content-between align-content-center">
                <div class=" sm-text"> <span class="md-text"> ${{ $property->price}}
                  </span>{{ $property->rental_period}}
                </div>
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

<section class="container-fluid">
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

{{-- <section class="container-fluid">
    <div class="container">
      <div class="row nextpage ">
        <div class="d-flex justify-content-center align-content-center flex-wrap">
          {{ $properties->links() }}
        </div>
      </div>
    </div>
  </section>--}}
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