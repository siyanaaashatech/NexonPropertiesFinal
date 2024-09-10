<!-- <section class="container-fluid">
  <div class="container gapbetweensection">
    <div class="d-flex justify-content-between">
      <div class="title">
        <div class="xs-text1 dashline">Trusted Real Estate Care</div>
        <div class="lg-text">Latest Project on Sale</div>
      </div>
      <a href="" class="btn-buttonyellow  py-1">View More</a>
    </div>
    <div class="row py-1 property-body">
    @foreach ($services as  $service )
    
    @endforeach
      <div class="col-md-6 pb-1">
        <div class="property-container">
          <img src="{{asset('image/bighouse.png')}}" alt="Property Image" class="imagecontroller imagecontrollerheight imagecontrollermd ">
          <div class="property-details">
            <div class="md-text1 p-0 m-0">Hello</div>
            <div class="md-text highlight text-center p-0 m-0">North road 435673Kth street</div>
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
            <p class="extra-small-text1 px-2">We wanted to take a moment to tell you what a We wanted to take a moment
              wanted to take a moment to tell you what a We wanted to take a moment wanted to take a moment to tell
              you what a We wanted to take a moment to tell
              you what a We wanted to take </p>
          </div>
        </div>
      </div>

      

      <div class="col-md-6 sub-image-content">
        <div class="row">
          @foreach ($services as $service)
        <div class="col-md-6 pb-1">
        <div class="property-container">
          @php
                $images = json_decode($service->image, true); // Decode the JSON array into a PHP array
              @endphp
              @if (!empty($images))
                @foreach ($images as $image)
                  <img class="property-image" src="{{ asset('storage/services/' . basename($image)) }}" alt="Property Image">
                @endforeach
              @else
                <p>No images available</p>
              @endif

          <div class="property-details">
          <div class="md-text1 p-0 m-0">{{ $service->title }}</div>
          <div class="sm-text highlight text-center p-0 m-0">{{ $service->subtitle }}</div>
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
          <p class="extra-small-text1 px-2 text-center">
            {{strlen($service->description) > 150 ? substr($service->description, 0, 150) . "..." : $service->description}}
          </p>
          </div>
        </div>
        </div>

      @endforeach
        </div>
      </div>
    </div>
   

  </div>
</section> -->

<!-- <section class="container">
<div class="property-container d-flex justify-content-center align-self-center gap-3 flex-wrap">
      <div class="btn-buttongreen"> <i class="fa-solid fa-house customicons customiconssmall"></i> sale</div>
      <div class="btn-buttongreen"> <i class="fa-solid fa-house customicons customiconssmall"></i> Condos</div>
      <div class="btn-buttongreen "> <i class="fa-solid fa-house customicons customiconssmall"></i> sale</div>
      <div class="btn-buttongreen "> <i class="fa-solid fa-house customicons customiconssmall"></i> Condos</div>
      <div class="btn-buttongreen "> <i class="fa-solid fa-house customicons customiconssmall"></i> sale</div>

    </div>

</section> -->

<section class="container-fluid ">
  <div class="container gapbetweensection">
    <div class=" d-flex flex-column justify-content-center align-items-center title pb-2  ">
      <div class="xs-text1 dashline">Trusted Real Estate Care</div>
      <div class="lg-text">Latest Project on Sale</div>
      <p class=" extra-small-text text-center col-md-7">Utilizing her exceptional experience and knowledge of
        the luxury waterfront markets, Simone serves an extensive and elite worldwide client base. </p>
    </div>
    <div class="row align-items-center justify-content-center">
      @foreach ($services as $service)
        <div class="col-md-4 mb-4">
        <div class="property-container rounded">
          @php
        $images = json_decode($service->image, true); // Decode the JSON array into a PHP array
    @endphp
          @if (!empty($images))
        @foreach ($images as $image)
      <img class="property-image" src="{{ asset('storage/services/' . basename($image)) }}" alt="Property Image">
    @endforeach
      @else
      <p>No images available</p>
    @endif

          <div class="property-details">
          <div class="md-text1 p-0 m-0">{{ $service->title }}</div>
          <div class="sm-text highlight text-center p-0 m-0">{{ $service->subtitle }}</div>
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
          <p class="extra-small-text1 px-2 text-center">
            {{strlen($service->description) > 150 ? substr($service->description, 0, 150) . "..." : $service->description}}
          </p>
          </div>
        </div>
        </div>

    @endforeach
    </div>


    <p class="d-flex justify-content-end ">
      <a href="" class="btn-buttonyellow py-1">View More</a>
    </p>

  </div>
</section>