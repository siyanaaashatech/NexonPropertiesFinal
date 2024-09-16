{{--navbar --}}

<section class="container-fluid navsection">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light navcustom">
      <a class="navbar-brand" href="/"> 
          <img src="{{ asset('image/logo.png') }}" alt="Logo" class="logoimg"/>
      </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
            @foreach($categories as $category)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('properties', ['categoryId' => $category->id]) }}">{{ $category->title }}</a>
                </li>
            @endforeach
        </ul>
      </div>
    </nav>
</div>

    
      <div class="button-collection  flex-column ">
        <a href="{{ route('register') }}" class="btn-buttonyellow reg-logbutton reg-logbutton-white mb-1">register</a>
        <a href="{{ route('login') }}" class="btn-buttonyellow reg-logbutton ">login</a>
      </div>
      <i class="fa-solid fa-bars customicons mx-4 " onclick="funmenu()"></i>
    </nav>
  </div>
  <div class="bur-menu py-3" id="bur-menu">
    <div class="activites">
      <h2 class="navdestext pt-3">activities section</h2>
      <li class="nav-item">
        <i class="fa-solid fa-house customiconssmall "></i>
        <a class="nav-link " aria-current="page" href="/">Introduction</a>
      </li>
      <li class="nav-item">

        <i class="fa-solid fa-truck-moving  customiconssmall"></i>
        <a class="nav-link " aria-current="page" href="{{route('properties')}}">Rent</a>
      </li>
      <li class="nav-item">
        <i class="fa-solid fa-cart-shopping customiconssmall"></i>
        <a class="nav-link" aria-current="page" href="{{route('properties')}}">Buy</a>
      </li>
    </div>
    <div class="information">
      <h2 class="navdestext">Information section</h2>
      <li class="nav-item d-flex">
        <i class="fa-solid fa-circle-question customiconssmall"></i>
        <a class="nav-link" aria-current="page" href="{{route("about")}}">About</a>
      </li>
      <li class="nav-item">
        <i class="fa-solid fa-blog customiconssmall"></i>
        <a class="nav-link active" aria-current="page" href="{{route("blog")}}">Blog</a>
      </li>
      <li class="nav-item">
        <i class="fa-solid fa-address-book customiconssmall"></i>
        <a class="nav-link active" aria-current="page" href="{{route('contact')}}">contact</a>
      </li>
    </div>
    <h2 class="navdestext">follow us</h2>
    <div class="d-flex font-collection py-2">
      <i class="fa-brands fa-facebook customicons mx-2"></i>
      <i class="fa-brands fa-linkedin customicons mx-2"></i>
      <i class="fa-brands fa-youtube customicons mx-2"></i>
      
    </div>
  </div>
</section>


<!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button> -->





{{--navbar --}}
<script>
  function funsearchingon() {
    const hiddenformdata = document.getElementsByClassName("hiddenform")[0];
    if (hiddenformdata.style.display === "block") {
      hiddenformdata.style.display = "none";
    }
    hiddenformdata.style.display = "block";

  }

  function funmenu() {
    const burmenu = document.getElementById("bur-menu");

    if (burmenu.style.display === "block") {
      burmenu.style.display = "none";
    } else {
      burmenu.style.display = "block";

    }
  }
</script>