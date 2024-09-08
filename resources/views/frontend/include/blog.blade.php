
<section class="container-fluid gapbetweensection">
  <div class="container">
    <div class="row mb-4">
      <div class="col-12">
        <div class="title text-center">
          <div class="xs-text1 dashline">Trusted Real Estate Care</div>
          <div class="lg-text">Latest BLOG for you</div>
        </div>
      </div>
    </div>

    <div class="swiper">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
        @foreach ($services as $service)
          <div class="swiper-slide">
            <div class="card my-1">
              <img class="card-img-top img-fluid" src="{{ asset('image/house1.png') }}" alt="Blog image">
              <div class="card-body">
                <h5 class="md-text">{{ $service->title }}</h5>
                <p class="sm-text">
                  {{ strlen($service->description) > 150 ? substr($service->description, 0, 150) . '...' : $service->description }}
                </p>
                <a href="{{ route('singleblogpost') }}" class="btn-buttonyellow">Read more</a>

              </div>
            </div>
          </div>
        @endforeach
      </div>
      

    </div>
  </div>
</section>


 