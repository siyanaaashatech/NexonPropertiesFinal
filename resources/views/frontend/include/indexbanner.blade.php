<section class="container-fluid">
    <div class="row">
      <div class="col-md-9 p-0 m-0">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner mb-2">
    <!-- Carousel Items -->
    @foreach ($services as $index => $service)
        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
            <div class="row d-flex">
                <div class="col-md-12 text-center d-flex flex-column justify-content-center align-items-center mb-2">
                    @php
                $images = json_decode($service->image, true); // Decode the JSON array into a PHP array
              @endphp
              @if (!empty($images))
                @foreach ($images as $image)
                  <img class="imagecontroller" src="{{ asset('storage/services/' . basename($image)) }}" alt="Blog image">
                @endforeach
              @else
                <p>No images available</p>
              @endif
                    <div class="flex bannercontent">
                        <div class="bannercontentinner">
                            <p class="sm-text1 mb-3 text-center forhidden">
                                More than <span class="highlight">1000+</span> houses available for sale & rent in the country
                            </p>
                            <h4 class="lg-text1 mb-4">{{$service->title}}</h4>

                            <div class="d-flex justify-content-center mb-1">
                                <div class="btn-buttonyellow btn-buttonyellowsmall">Buy</div>
                                <div class="btn-buttongreen mx-2">Rent</div>
                            </div>
                            <div class="formsection flex-column justify-content-center align-items-center py-md-3 py-2 gap-2 col-md-10 px-4 mx-md-4">
                                <div class="d-flex flex-wrap gap-md-3 showform">
                                    <input type="text" class="input bannerinput" placeholder="List type">
                                    <input type="text" class="input bannerinput" placeholder="property type">
                                    <input type="text" class="input bannerinput" placeholder="Location">
                                    <input type="text" class="input bannerinput" placeholder="Price">
                                    <input type="text" class="input bannerinput" placeholder="Bedroom">
                                    <button class="btn-buttongreen bannerinput">Search</button>
                                </div>
                            </div>
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
        @foreach ($services as  $service )
        <div class="property-container mx-2 subbanner-hidden " >
          @php
                $images = json_decode($service->image, true); // Decode the JSON array into a PHP array
              @endphp
              @if (!empty($images))
                @foreach ($images as $image)
                  <img class="property-image  property-imageheight" src="{{ asset('storage/services/' . basename($image)) }}" alt="Blog image">
                @endforeach
              @else
                <p>No images available</p>
              @endif









          <div class="property-details">
            <div class="md-text1">{{$service->title}}</div>
            <div class="sm-text highlight text-center p-0 m-0">{{$service->subtitle}}</div>
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
                <i class="fa-solid fa-bed detail-icon"></i>
              </p>
            </div>
            <p class="extra-small-text1 px-2">{{ strlen($service->description)>150 ? substr($service->description,0,150)."...": $service->description}}</p>
          </div>
        </div>
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



  <section class="container-fluid py-4 propertiesfinder propertiesfinderhome">
    <div class="container">
      <h1 class="lg-text1 text-center searchhide" onclick="funsearchingon()">
        <i class="fa-brands fa-searchengin customicons"></i> Find your properties
      </h1>
      <div class="justify-content-center align-items-center gap-1 flex-wrap hiddenform hiddenformhome" id="hiddenform">
        <div class="d-flex flex-column col-md-3">
          <label for="" class="sm-text1 des-text">Listing type</label>
          <input type="text" class="input bannerinput">
        </div>
        <div class="d-flex flex-column col-md-3">
          <label for="" class="sm-text1 des-text">Properties type</label>
          <input type="text" class="input bannerinput">
        </div>
        <div class="d-flex flex-column col-md-3">
          <label for="" class="sm-text1 des-text">Location</label>
          <input type="text" class="input bannerinput">
        </div>
        <div class="d-flex flex-column col-md-3">
          <label for="" class="sm-text1 des-text">Location</label>
          <input type="text" class="input bannerinput">
        </div>
        <div class="d-flex flex-column col-md-3">
          <label for="" class="md-text1 des-text">Price</label>
          <input type="text" class="input bannerinput">
        </div>
        <div class="d-flex flex-column col-md-3">
          <label for="" class="sm-text1 des-text">Search</label>
          <button class="btn-buttonyellow btn-buttonyellowlg">Find properties</button>
        </div>

      </div>
    </div>
  </section>


  <script>
document.addEventListener('DOMContentLoaded', function() {
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

