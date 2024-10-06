<footer class="container-fluid container-fluid-background">
  <div class="container">
    <div class="row  d-flex justify-content-between">
      <div class="col-md-3 flex-col sm-col-12">
        <img src="{{asset("image/logo.png")}}" alt="" class="logoimg ">
        <p class="sm-text1 py-1 pt-3">
          Welcome to pagename where our passion for real estate and dedication to
          client satisfaction converge to create an unparalleled home-buying experience. Founded </p>
        <div class="d-flex font-collection py-2">
          <i class="fa-brands fa-facebook customicons mx-2"></i>
          <i class="fa-brands fa-linkedin customicons mx-2"></i>
          <i class="fa-brands fa-youtube customicons mx-2"></i>
          <i class="fa-brands fa-instagram customicons mx-2"></i>
        </div>
      </div>
      <div class="col-md-2 sm-col-12 mx-4 ">
        <h1 class="md-text1 highlight minuspadding">Quick link</h1>
        <ul class="d-flex justify-content-around  customui flex-column gap-2">
          <li><a href=""> Rent</a></li>
          <li><a href="">Buy</a></li>
          <li><a href="">About</a></li>
          <li><a href="">Blog</a></li>
        </ul>
      </div>
      <div class="col-md-2 sm-col-12 mx-4 ">
        <h1 class="md-text1 highlight minuspadding">Regions</h1>
        <ul class="d-flex justify-content-around customui flex-column gap-2">
         
         
          

        </ul>
      </div>
      <div class="col-md-3 col-sm-12 ">
        <h1 class="md-text1 highlight">Message us</h1>
        <input type="text" class="input" placeholder="Your email id here">
        <textarea name="" id="" rows="1" cols="" class="textarea my-1 "></textarea>
        <a href="{{ route('login') }}" class="btn-buttonyellow  footer-button">send message</a>
      </div>
    </div>
  </div>
</footer>

<div class="container-fluid button-footer">
  <div class="container d-flex align-items-center  justify-content-center flex-column py-">
  <p class="sm-text1 pt-4 greenhighlight">All rights reserved by <span class="highlight">Aasha Tech </span> © <span id="currentYear"></span></p>
  
   <!-- <ul class="d-flex justify-content-around customui">
        <li><a href="" class=" mx-1 line">fAQ</a></li>
        <li><a href="" class=" mx-1 line">Policy</a></li>
        <li><a href="" class=" mx-2">Term and Condition</a></li>

      </ul> -->

</div>
</div>

<script>
      // JavaScript to dynamically insert the current year
      document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>
