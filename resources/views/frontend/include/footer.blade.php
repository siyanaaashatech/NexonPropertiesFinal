<footer class="container-fluid container-fluid-background">
  <div class="container">
    <div class="row  d-flex justify-content-between align-items-center">
      <div class="col-md-4 flex-col sm-col-12">
        <img src="{{asset("image/logo.png")}}" alt="" class="logoimg ">
        <p class="sm-text1 py-1">
          Welcome to pagename where our passion for real estate and dedication to
          client satisfaction converge to create an unparalleled home-buying experience. Founded </p>
        <div class="d-flex font-collection py-2">
          <i class="fa-brands fa-facebook customicons mx-2"></i>
          <i class="fa-brands fa-linkedin customicons mx-2"></i>
          <i class="fa-brands fa-youtube customicons mx-2"></i>
          <i class="fa-brands fa-youtube customicons mx-2"></i>
        </div>
      </div>
      <div class="col-md-2 sm-col-12 mx-4 ">
        <h1 class="md-text1 highlight minuspadding">Quick link</h1>
        <ul class="d-flex justify-content-around  customui flex-column gap-2">
          <li><a href=""> <i class="fa-solid fa-truck-moving  customiconssmall"></i>Rent</a></li>
          <li><a href=""><i class="fa-solid fa-cart-shopping customiconssmall"></i>Buy</a></li>
          <li><a href=""> <i class="fa-solid fa-address-book customiconssmall"></i>About</a></li>
          <li><a href=""><i class="fa-solid fa-blog customiconssmall"></i>Blog</a></li>
        </ul>
      </div>
      <div class="col-md-2 sm-col-12 mx-4">
        <h1 class="md-text1 highlight minuspadding">sub Categories</h1>
        <ul class="d-flex justify-content-around customui flex-column gap-2">
          <li><a href=""> <i class="fa-solid fa-truck-moving  customiconssmall"></i>Rent</a></li>
          <li><a href=""><i class="fa-solid fa-cart-shopping customiconssmall"></i>Buy</a></li>
          <li><a href=""> <i class="fa-solid fa-address-book customiconssmall"></i>About</a></li>
          <li><a href=""><i class="fa-solid fa-blog customiconssmall"></i>Blog</a></li>
        </ul>
      </div>
      <div class="col-md-3 col-sm-12  py-1">
        <h1 class="md-text1 highlight">Message us</h1>
        <input type="text" class="input" placeholder="Your email id here">
        <textarea name="" id="" rows="1" cols="" class="textarea my-1"></textarea>
        <a href="{{ route('login') }}" class="btn-buttonyellow footer-button">send message</a>
      </div>
    </div>
  </div>
</footer>

<div class="container-fluid button-footer">
  <div class="container d-flex align-items-center  justify-content-center flex-column py-2">
  <p class="sm-text1 pt-7">All rights reserved by Aasha Tech © <span id="currentYear"></span></p>

    <!-- <ul class="d-flex justify-content-around customui">
        <li><a href="" class=" mx-1 line">fAQ</a></li>
        <li><a href="" class=" mx-1 line">Policy</a></li>
        <li><a href="" class=" mx-2">Term and Condition</a></li>

      </ul> -->
    

    <script>
      // JavaScript to dynamically insert the current year
      document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>


  </div>
</div>