<section class="container-fluid">
  <div class="container gapbetweensection">
    <div class="d-flex justify-content-between">
      <div class="title">
        <div class="xs-text1 dashline">Trusted Real Estate Care</div>
        <div class="lg-text">Latest Project on Sale</div>
      </div>
      <a href="" class="btn-buttonyellow py-1">View More</a>
    </div>

    <div class="row py-1 property-body">
      @foreach ($properties as $property)
        <div class="col-md-6 pb-1">
          <div class="property-container">
            @php
              // Decode the JSON encoded images from the property
              $mainImages = !empty($property->other_images) ? json_decode($property->other_images, true) : [];
              // Fetch the first image from the array or fallback to a placeholder if empty
              $mainImage = !empty($mainImages) 
                  ? asset('storage/property/other-images/' . $mainImages[0]) 
                  : asset('images/default-placeholder.png');
            @endphp

            <!-- Display the main image of the property -->
            <img src="{{ $mainImage }}" alt="Property Image" class="imagecontroller imagecontrollerheight imagecontrollermd">
            
            <div class="property-details">
              <div class="md-text1 p-0 m-0">{{ $property->title }}</div>
              <div class="md-text highlight text-center p-0 m-0">{{ $property->street }}, {{ $property->suburb }}</div>
              <div class="d-flex justify-content-between gap-3 p-0 mx-4">
                <p class="detail-item sm-text1">
                  <span class="sm-text1">{{ $property->bedrooms }}</span><br />
                  <i class="fa-solid fa-bed detail-icon"></i>
                </p>
                <p class="detail-item sm-text1">
                  <span class="detail-number">{{ $property->bathrooms }}</span><br />
                  <i class="fa-solid fa-bath detail-icon"></i>
                </p>
                <p class="detail-item sm-text1">
                  <span class="sm-text1">{{ $property->area }} sq ft</span><br />
                  <i class="fa-solid fa-ruler-combined detail-icon"></i>
                </p>
              </div>
              <p class="extra-small-text1 px-2">{{ Str::limit($property->description, 150, '...') }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Sub button section -->
<section class="container">
  <div class="property-container d-flex justify-content-center align-self-center gap-3 flex-wrap">
    <div class="btn-buttongreen">
      <i class="fa-solid fa-house customicons customiconssmall"></i> Sale
    </div>
    <div class="btn-buttongreen">
      <i class="fa-solid fa-house customicons customiconssmall"></i> Condos
    </div>
    <div class="btn-buttongreen">
      <i class="fa-solid fa-house customicons customiconssmall"></i> Sale
    </div>
    <div class="btn-buttongreen">
      <i class="fa-solid fa-house customicons customiconssmall"></i> Condos
    </div>
    <div class="btn-buttongreen">
      <i class="fa-solid fa-house customicons customiconssmall"></i> Sale
    </div>
  </div>
</section>
