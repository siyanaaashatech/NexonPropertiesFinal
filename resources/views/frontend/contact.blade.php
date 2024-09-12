@extends("frontend.layouts.master")
@section("content")
<!-- bannersection -->
<section class="container-fluid">
  <div class="row">
    <div class="col-md-12 p-0">
      <div class="carousel-inner mb-3">
        <div class="row d-flex">
          <div class="col-md-12 text-center d-flex flex-column justify-content-center align-items-center mb-2 ">
            <img src="{{ asset('image/contact.png') }}" alt="" srcset="" class="imagecontroller imagecontrollerheight imagecontrollerheightextra">
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
    <div class="row d-flex  justify-content-center align-items-center gap-2">
    @foreach ($siteSettings as $siteSetting)
      <div class="col-md-3 greenbackground d-flex  justify-content-center align-items-center">
        <i class="fa-solid fa-location-dot customiconslarge"></i>
        <div class="information">
          <h2 class="md-text1">office address</h2>
          <h2 class="extra-small-text1">{{$siteSetting ->office_address}}</h2>
        </div>
      </div>
      <div class="col-md-3 greenbackground d-flex  justify-content-center align-items-center">
        <i class="fa-solid fa-envelope  customiconslarge"></i>
        <div class="information">
        <h2 class="md-text1">office Contact</h2>
        <h2 class="extra-small-text1">{{$siteSetting ->office_contact}}</h2>
        </div>
      </div>
      <div class="col-md-3 greenbackground d-flex  justify-content-center align-items-center">
        <i class="fa-solid fa-phone customiconslarge"></i>
        <div class="information">
        <h2 class="md-text1">office email </h2>
        <h2 class="extra-small-text1">{{$siteSetting ->office_email}}</h2>
        </div>
      </div>
    </div>
    @endforeach
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







<!-- <style>
  
@keyframes moveImages {
     0% {
       transform: translatey(0);
     }
     100% {
       transform: translatey(100px);
     }
   }
   
   .propertype-subimage {
     transition: transform 1s ease-in-out;
  
   }
   
   .propertype-subimage.animate {
     animation: moveImages 6s forwards;
   }
</style>
<script>
document.addEventListener("DOMContentLoaded", function() {
  setTimeout(function() {
    document.querySelectorAll('.propertype-subimage').forEach(function(item) {
      item.classList.add('animate');
    });
  }, 3000); // 3 seconds delay
});
</script> -->



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




</body>

</html>