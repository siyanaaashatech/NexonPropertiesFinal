@extends("frontend.layouts.master")
@section("content")
<!-- bannersection -->
<section class="container-fluid">
  <div class="row">
    <div class="col-md-12 p-0">
      <div class="carousel-inner mb-3">
        <div class="row d-flex">
          <div class="col-md-12 text-center d-flex flex-column justify-content-center align-items-center mb-2 ">
            <img src="{{ asset('image/contact.jpg') }}" alt="" srcset="" class="imagecontroller imagecontrollerheight imagecontrollerheightextra">
            <div class="flex bannercontentheight">
              <div class="bannercontentinnerheight ">
                <h4 class="lg-text1">Contact</h4>
                <h5 class="md-text1"><a href="">home</a> <i class="fa-solid fa-angle-right "></i>
                  <span class="highlight">contact</span>
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
<!-- detailsection -->
<section class="container-fluid contact">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center gap-2">
      @foreach ($siteSettings as $siteSetting)
        <div class="col-md-3 greenbackground d-flex justify-content-center align-items-center">
          <i class="fa-solid fa-location-dot customiconslarge"></i>
          <div class="information">
            <h2 class="md-text1">Office Address</h2>
            <h2 class="sm-text1">
              @if(is_array(json_decode($siteSetting->office_address, true)))
                {{ implode(', ', json_decode($siteSetting->office_address)) }}
              @else
                {{ $siteSetting->office_address }}
              @endif
            </h2>
          </div>
        </div>
        <div class="col-md-3 greenbackground d-flex justify-content-center align-items-center">
          <i class="fa-solid fa-envelope customiconslarge"></i>
          <div class="information">
            <h2 class="md-text1">Office Contact</h2>
            <h2 class="sm-text1">
              @if(is_array(json_decode($siteSetting->office_contact, true)))
                {{ implode(', ', json_decode($siteSetting->office_contact)) }}
              @else
                {{ $siteSetting->office_contact }}
              @endif
            </h2>
          </div>
        </div>
        <div class="col-md-3 greenbackground d-flex justify-content-center align-items-center">
          <i class="fa-solid fa-phone customiconslarge"></i>
          <div class="information">
            <h2 class="md-text1">Office Email</h2>
            <h2 class="sm-text1">
              @if(is_array(json_decode($siteSetting->office_email, true)))
                {{ implode(', ', json_decode($siteSetting->office_email)) }}
              @else
                {{ $siteSetting->office_email }}
              @endif
            </h2>
          </div>
        </div>
      @endforeach
      @endforeach
    </div>
  </div>
</section>
<section class="container-fluid  my-5 form-map py-4 ">
  <div class="row d-flex  justify-content-center align-items-center mx-2">
    <div class="col-md-4 contentbackground px-4 m-2">
      <div class="d-flex flex-column gap-2">
        <p class="extra-small-text1">Are you ready to embark on a journey of self-discovery, inner peace, and holistic
          well-being?
          Join our Yoga and Meditation class, and connect with us to explore the transformative power of
          mindfulness and movement.</p>
        <div class="d-flex flex-column">
          <label for="" class="xs-text pb-1">Your full Name</label>
          <input type="text" name="" id="" class="input" placeholder="Person name" />
        </div>
        <div class="d-flex flex-column">
          <label for="" class="xs-text pb-1">Email Address</label>
          <input type="text" name="" id="" class="input" placeholder="Person name" />
        </div>
        <div class="d-flex flex-column">
          <label for="" class="xs-text pb-1">Message</label>
          <textarea name="" id="" class="textarea" placeholder="message"></textarea>
        </div>
        <button class="btn-buttonyellow btn-buttonyellowlarge mt-1 ">Send</button>
      </div>
    </div>
    <div class="col-md-6">
      <img src="{{asset("image/map.png")}}" alt="" class="contactbodyimage">
    </div>
  </div>
</section>
@endsection
<script>
  function funmenu() {
    const burmenu = document.getElementById("bur-menu");
    if (burmenu.style.display === "block") {
      burmenu.style.display = "none";
    } else {
      burmenu.style.display = "block";
    }
  }
</script>