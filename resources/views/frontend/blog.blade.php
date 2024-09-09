@extends('frontend.layouts.master')
@section("content")



<section class="singlepage pt-4">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="row d-flex flex- col ">
          @foreach ($services as $service)
        <div class="col-md-12 mb-3">
        <img src="{{asset('image/house1.png')}}" alt="" srcset="" class="imagecontroller imagecontrollermd">
        <div class=" d-flex gap-3 py-3">
          <div class="d-flex ">
          <i class="fa-solid fa-person customiconssmall pt-1 mx-1"></i>
          <h2 class="sm-text">Real</h2>
          </div>
          <div class="d-flex ">
          <i class="fa-solid fa-calendar-days customiconssmall pt-1 mx-1"></i>
          <h2 class="sm-text text-center">june 8,2024</h2>
          </div>
          <div class="d-flex">
          <i class="fa-solid fa-building customiconssmall pt-1 mx-1"></i>
          <h2 class="sm-text">type</h2>
          </div>

        </div>
        <h5 class="md-text">{{$service -> title}}</h5>
        <p class="sm-text py-1">{{$service -> description}}
        </p>
        <a href="{{ route('singleblogpost') }}" class="btn-buttonyellow">Read more</a>
        </div>
      @endforeach
        </div>


      </div>
      <div class="col-md-4 sidebar  ">
        <div class="paddingbox">
          <input type="text" name="" id="" class="input">
        </div>
        <div class="paddingbox ">
          <h2 class="md-text1">Recent post</h2>
          <ul class="customui">
            <li class="py-1"><a href="" class="md-text"> <i
                  class="fa-solid fa-hand-point-right customicons customiconssmall "></i>
                When should I open your gift?</a></li>
            <li class="py-1"><a href="" class="md-text"> <i
                  class="fa-solid fa-hand-point-right customicons customiconssmall "></i>
                Are you supporting England,</a></li>
            <li class="py-1"><a href="" class="md-text"> <i
                  class="fa-solid fa-hand-point-right customicons customiconssmall "></i>
                When should I open your gift?</a></li>
            <li class="py-1"><a href="" class="md-text"> <i
                  class="fa-solid fa-hand-point-right customicons customiconssmall "></i>
                Are you supporting England, </a></li>

          </ul>

        </div>
        <div class="paddingbox nobackground">
          <h2 class="md-text">feature list</h2>
          <div class="featurelist-body">
            <div class="featurelist-content d-flex py-1">
              <img class="feature-smallimg" data-src="holder.js/200x250?theme=thumb" alt=""
                src="{{asset('image/bighouse.png')}}" />
              <div class="featurlist-description mx-3">
                <h3 class="sm-text">luxury house in greenville</h3>
                <p class="sm-text highlight"> $130000</p>

              </div>
            </div>
            <div class="featurelist-content d-flex  py-1">
              <img class="feature-smallimg" data-src="holder.js/200x250?theme=thumb" alt=""
                src="{{asset('image/bighouse.png')}}" />
              <div class="featurlist-description mx-3">
                <h3 class="sm-text">luxury house in greenville</h3>
                <p class="sm-text highlight"> $1900000</p>

              </div>
            </div>
            <div class="featurelist-content d-flex  py-1">
              <img class="feature-smallimg" data-src="holder.js/200x250?theme=thumb" alt=""
                src="{{asset('image/bighouse.png')}}" />
              <div class="featurlist-description mx-3">
                <h3 class="sm-text">luxury house in greenville</h3>
                <p class="sm-text highlight"> $130000</p>

              </div>
            </div>


          </div>
        </div>

      </div>
    </div>

  </div>

</section>


@endsection
<!-- each team des -->
<!-- banner section -->


<script>

  function changepage(element) {
    const pageli = document.getElementsByClassName("nextli");
    for (let i = 0; i < pageli.length; i++) {
      pageli[i].classList.remove("activeli");

    }

    element.classList.add("activeli")
  }
</script>