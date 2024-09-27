<section class="container-fluid">
  <div class="row">
    <div class="col-md-9 p-0 m-0">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner mb-2">
          <!-- Carousel Items -->
          @foreach ($properties as $index => $property)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
            <div class="row d-flex">
              <div class="col-md-12 text-center d-flex flex-column justify-content-center align-items-center mb-2">

              @php
                $mainImages = !empty($property->main_image) ? json_decode($property->main_image, true) : [];
                $mainImage = !empty($mainImages) ? asset('' . $mainImages[0]) : asset('images/default-placeholder.png');
              @endphp
              <img src="{{ $mainImage }}" alt="Property Image" class="imagecontroller">
              <div class="flex bannercontent">
                <div class="bannercontentinner">
                <p class="sm-text1 mb-3 text-center forhidden">
                  More than <span class="highlight">1000+</span> houses available for sale & rent in the country
                </p>
                <h4 class="lg-text1 mb-4">{{$property->title}}</h4>
                <!-- <div class="d-flex justify-content-center mb-1">
              <div class="btn-buttonyellow btn-buttonyellowsmall">Buy</div>
              <div class="btn-buttongreen mx-2">Rent</div>
              </div> -->
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
             
                </div>
              </div>
              </div>
            </div>
            </div>
      @endforeach
        </div>
      </div>
    </div>



    <div class="col-md-3">
      <div class="row">
        <div class="col-md-12 p-0 ">
          @foreach ($properties as $property)
            <a href="{{route('singleproperties', ['id' => $property->id])}}">
            <div class="property-container mx-2 subbanner-hidden ">
              @php
        $mainImages = !empty($property->main_image) ? json_decode($property->main_image, true) : [];
        $mainImage = !empty($mainImages) ? asset('' . $mainImages[0]) : asset('images/default-placeholder.png');
         @endphp
              <img src="{{ $mainImage }}" alt="Property Image" class="property-image  property-imageheightbanner">
              <div class="property-details property-detailsbanner px-1">
              <div class="md-text1">
                {{ strlen($property->title) >28 ? substr($property->title, 0, 28)  : $property->title}}
              </div>
              <div class="sm-text highlight text-center p-0 m-0"> <i class="fa-solid fa-location-dot mx-2"></i>{{ $property->state }}-{{ $property->suburb }}-{{ $property->street }}</div>
              <div class="d-flex justify-content-between gap-3 p-0 mx-4">
                <p class="detail-item sm-text1">
                <span class="sm-text1">13</span><br />
                <i class="fa-solid fa-bed detail-icon"></i>
                </p>
                <p class="detail-item sm-text1">
                <span class="detail-number">02</span><br />
                <i class="fa-solid fa-bath detail-icon"></i>
                </p>
                <p class="detail-item sm-text1">
                <span class="sm-text1">13</span><br />
                <i class="fa-solid fa-chart-area  detail-icon"></i>
                </p>
              </div>
              <p class="extra-small-text1 px-2">
                {{ strlen($property->description) > 150 ? substr($property->description, 0, 150) . "..." : $property->description}}
              </p>
              </div>
            </div>
            </a>
      @endforeach
        </div>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </a>
</section>


<form action="{{ route('frontend.searching') }}" method="GET" id="propertySearchForm">
  <div class="formsection flex-column justify-content-center align-items-center py-md-3 py-2 gap-2 col-md-7 px-4 ">
    <div class="d-flex flex-wrap gap-md-3 showform">
    <input type="text" class="input bannerinput" name="location" placeholder="Keyword"
    value="{{ request('location') }}">
      <select class="input bannerinput" name="category_id" id="category_id">
        <option value="" disabled selected>Select Category</option>
        @foreach($categories as $category)
          <option value="{{ $category->id }}">{{ $category->title }}</option>
        @endforeach
      </select>
      <select class="input bannerinput" name="subcategory_id" id="subcategory_id">
        <option value="" disabled selected>Select Subcategory</option>
      </select>
      <select class="input bannerinput" name="state" id="state">
        <option value="" disabled selected>Select State</option>
        @foreach($states as $state)
          <option value="{{ $state }}">{{ $state }}</option>
        @endforeach
      </select>
      <select class="input bannerinput" name="suburb" id="suburb">
        <option value="" disabled selected>Select Region</option>
      </select>
     
      <span class="sm-text mt-2 greenhighlight advance mx-2" onclick="funOpenadvance()">Advanced ::</span>
      <button type="submit" class="btn-buttongreen">Search</button>
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
  document.addEventListener('DOMContentLoaded', function () {
    const items = document.querySelectorAll('.subbanner-hidden');
    const animationDuration = 4000; // Duration of the entire animation cycle
    const initialDisplayDuration = 1000; // Duration to show initial items

    let currentIndex = 0;

    function showNextItems() {
      // Hide all items
      items.forEach(item => {
        item.classList.remove('visible-item');
        item.classList.add('subbanner-hidden');
      });

      // Calculate the indices for the next three items
      const nextIndex1 = currentIndex;
      const nextIndex2 = (currentIndex + 1) % items.length;
      const nextIndex3 = (currentIndex + 2) % items.length;

      // Show the next three items
      items[nextIndex1].classList.remove('subbanner-hidden');
      items[nextIndex1].classList.add('visible-item');

      items[nextIndex2].classList.remove('subbanner-hidden');
      items[nextIndex2].classList.add('visible-item');

      items[nextIndex3].classList.remove('subbanner-hidden');
      items[nextIndex3].classList.add('visible-item');

      // Update the current index for the next set of items
      currentIndex = (currentIndex + 3) % items.length;
    }

    function showInitialItems() {
      // Initially show the first three items
      if (items.length > 0) {
        items[0].classList.remove('subbanner-hidden');
        items[0].classList.add('visible-item');
      }
      if (items.length > 1) {
        items[1].classList.remove('subbanner-hidden');
        items[1].classList.add('visible-item');
      }
      if (items.length > 2) {
        items[2].classList.remove('subbanner-hidden');
        items[2].classList.add('visible-item');
      }

      // Set a timeout to start the animation loop after the initial display duration
      setTimeout(() => {
        // Start showing items in the loop
        setInterval(showNextItems, animationDuration);
      }, initialDisplayDuration);
    }

    // Start the process
    showInitialItems();
  });

</script>


<script>
   document.addEventListener('DOMContentLoaded', function () {
      const categorySelect = document.getElementById('category_id');
      const subCategorySelect = document.getElementById('subcategory_id');
      function filterSubcategories() {
        const selectedCategoryId = categorySelect.value;
        const subCategories = subCategorySelect.querySelectorAll('option');
        subCategories.forEach(option => {
            if (!option.value) return; // Skip the "Select Sub-Category" option
                option.style.display = option.dataset.categoryId === selectedCategoryId || selectedCategoryId === '' ? 'block' : 'none';
              });
                // Reset subcategory selection when category changes
                    subCategorySelect.value = '';
      }
      // Initial filter when the page loads
      filterSubcategories();
     // Update subcategories when the category is changed
        categorySelect.addEventListener('change', filterSubcategories);
    });
</script>

