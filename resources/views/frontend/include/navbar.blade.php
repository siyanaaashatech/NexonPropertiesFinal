{{--navbar --}}
<section class="container-fluid navsection">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light navcustom">
      <a class="navbar-brand" href="/"> <img src="{{ asset('image/logo.png') }}" alt="Logo" class="logoimg" /></a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
          @foreach($categories as $category)
        <li class="nav-item">
        <a class="nav-link"
          href="{{ route('properties', ['categoryId' => $category->id]) }}">{{ $category->title }}</a>
        </li>
      @endforeach
        </ul>
      </div>
      <div class="button-collection d-flex flex-column justify-content-center">
        @guest
      <a href="{{ route('register') }}" class="btn-buttonyellow reg-logbutton reg-logbutton-white mb-1">Register</a>
      <a href="{{ route('login') }}" class="btn-buttonyellow reg-logbutton">Login</a>
    @else
    <span class="welcome-message sm-text1"> {{ Auth::user()->name }}</span>
    {{-- <a href="{{ route('profile') }}" class="btn-buttonyellow reg-logbutton">Profile</a> --}}
    <div class="d-flex">
      <div class="">
      <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        class="btn-buttonyellow reg-logbutton">Logout</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </div>
      
      <a href="{{ route('favourite') }}" class="d-flex fav mainitems-fav">
          <p class="sm-text1 counter">{{ auth()->user()->favorites()->count() }}</p>
          <i class="fa-solid fa-heart"></i>
      </a>
      
      <script>
      document.addEventListener('DOMContentLoaded', function() {
          // Remove localStorage usage
          let counterElement = document.querySelector('.counter');
          
          // Event listener for Add to Favorite button
          document.querySelector('.favourite').addEventListener('click', function () {
              var propertyId = this.getAttribute('data-property-id');
      
              // AJAX request to add property to favorites
              $.ajax({
                  url: '{{ route("favorites.store") }}',
                  type: 'POST',
                  data: {
                      _token: '{{ csrf_token() }}',
                      properties_id: propertyId
                  },
                  success: function (response) {
                      if (response.status === 'success') {
                          if (response.count !== undefined) {
                              // Update the favorite count in the navbar
                              if (counterElement) {
                                  counterElement.textContent = response.count;
                              }
                          }
                          alert(response.message);
                      } else if (response.status === 'already_added') {
                          alert('Already added to favorites');
                      } else {
                          alert('An unexpected error occurred');
                      }
                  },
                  error: function (xhr) {
                      alert('An error occurred while processing your request');
                  }
              });
          });
      });
      </script>
    
    </div>
    </form>
  @endguest
      </div>
      <i class="fa-solid fa-bars customicons mx-4 p-0 m-0" onclick="funmenu()"></i>
    </nav>
  </div>
  <div class="bur-menu py-3" id="bur-menu">
    <div class="activites">
      <h2 class="navdestext pt-3">Activities Section</h2>
      <li class="nav-item">
        <i class="fa-solid fa-house customiconssmall"></i>
        <a class="nav-link" aria-current="page" href="/">Introduction</a>
      </li>
      <li class="nav-item">
        <i class="fa-solid fa-truck-moving customiconssmall"></i>
        <a class="nav-link" aria-current="page" href="{{ route('properties') }}">Rent</a>
      </li>
      <li class="nav-item">
        <i class="fa-solid fa-cart-shopping customiconssmall"></i>
        <a class="nav-link" aria-current="page" href="{{ route('properties') }}">Buy</a>
      </li>
    </div>
    <div class="information">
      <h2 class="navdestext">Information Section</h2>
      <li class="nav-item d-flex">
        <i class="fa-solid fa-circle-question customiconssmall"></i>
        <a class="nav-link" aria-current="page" href="{{ route('about') }}">About</a>
      </li>
      <li class="nav-item">
        <i class="fa-solid fa-blog customiconssmall"></i>
        <a class="nav-link active" aria-current="page" href="{{ route('blog') }}">Blog</a>
      </li>
      <li class="nav-item">
        <i class="fa-solid fa-address-book customiconssmall"></i>
        <a class="nav-link active" aria-current="page" href="{{ route('contact') }}">Contact</a>
      </li>
    </div>
    <h2 class="navdestext">Follow Us</h2>
    <div class="d-flex font-collection py-2">
      <a href="#"><i class="fa-brands fa-facebook customicons mx-2"></i></a>
      <a href="#"><i class="fa-brands fa-linkedin customicons mx-2"></i></a>
      <a href="#"><i class="fa-brands fa-instagram customicons mx-2"></i></a>
    </div>
  </div>
</section>
<script>
  function funsearchingon() {
    const hiddenformdata = document.getElementsByClassName("hiddenform")[0];
    hiddenformdata.style.display = hiddenformdata.style.display === "block" ? "none" : "block";
  }
  function funmenu() {
    const burmenu = document.getElementById("bur-menu");
    burmenu.style.display = burmenu.style.display === "block" ? "none" : "block";
  }
</script>