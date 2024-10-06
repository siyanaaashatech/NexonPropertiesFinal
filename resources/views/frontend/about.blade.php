@extends("frontend.layouts.master")
@section("content")

<!-- bannersection -->
<section class="container-fluid otherpagebanner">
    <div class="row">
        <div class="col-md-12 p-0">
            <div class="carousel-inner mb-3">
                <div class="row d-flex">
                    <div
                        class="col-md-12 text-center d-flex flex-column justify-content-center align-items-center mb-2 ">
                        <img src="{{ asset('image/newabout.png') }}" alt="" srcset=""
                            class="imagecontroller imagecontrollerheight imagecontrollerheightextra">
                        <div class="flex bannercontentheight">
                            <div class="bannercontentinnerheight ">
                                <h4 class="lg-text1">About</h4>
                                <h5 class="md-text1"><a href="">home</a> <i class="fa-solid fa-angle-right "></i>
                                    <span class="highlight">about</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>


<!-- companydescription -->

<section class="container">
    <div class="row d-flex align-items-start justify-content-center gap-1">

        <div class="container d-flex flex-column justify-content-center align-items-center">
            <div class="row py-4">
                {{-- @foreach ($aboutuss as $aboutus) --}}
    

                <div class="col-md-12 mx-md-4 mb-3">
                    <div class="title">
                        <div class="xs-text dashline text-black">Trusted Real estate Care</div>
                        <div class="lg-text1 text-success">Dream living Spaces Setting New Build</div>
                    </div>
                    {{-- @foreach ($aboutuss as $aboutus) --}}
                    <p class="sm-text1 text-black">{{ $aboutuss->description }}</p>
                    {{-- <div class="d-flex">
                        <i class="fa-solid fa-hand-point-right customicons mx-2"></i>
                        <p class="sm-text1">{{$aboutus->description}}</p>
                      </div>
                  
                      <div class="d-flex">
                        <i class="fa-solid fa-hand-point-right customicons mx-2"></i>
                        <p class="sm-text1">{{$aboutus->description}}</p>
                      </div> --}}
                    {{-- @endforeach --}}
                </div>

                    <div class="col-md-12 d-flex mb-4">
                        <div class="image col-md-6 first">
                            @php
                                $images = json_decode($aboutuss->image, true);
                            @endphp
    
                            @if (!empty($images) && isset($images[0]))
                                <img src="{{ asset('storage/aboutus/' . basename($images[0])) }}" alt="aboutus">
                            @else
                                <p>No image available</p>
                            @endif
                        </div>
    
                        <div class="image col-md-6 my-2 mx-1 second">
                            @php
                                $images = json_decode($aboutuss->image, true);
                            @endphp
    
                            @if (!empty($images) && isset($images[1]))
                                <img src="{{ asset('storage/aboutus/' . basename($images[1])) }}" alt="aboutus">
                            @else
                                <p>No image available</p>
                            @endif
                        </div>
                    </div>
    
                {{-- @endforeach --}}
             
            </div>
        </div>



        <!-- First Column -->
        {{-- <div class="col-md-6">
            @if(count($aboutDescriptions) > 0)
                        @php
                            // Get the first item and remove it from the collection
                            $firstDescription = $aboutDescriptions->shift();
                        @endphp
                        <h1 class="md-text text-center">{{ $firstDescription->title }}</h1>
                        <p class="extra-small-text text-center">{{ $firstDescription->description }}</p>
            @endif
        </div> --}}

        <!-- Second Column with Flexbox -->
        {{-- <div class="col-12">
            <div class="d-flex flex-wrap  justify-content-center">
                @foreach($aboutDescriptions->take(4) as $description)
                    <div class="col-md-5 m-1">
                        <div class="flex-item">
                            <h1 class="md-text text-center">{{ $description->title }}</h1>
                            <p class="extra-small-text text-center">{{ $description->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}

        <!-- Remaining Data -->
        @if($aboutDescriptions->count() > 5)
            <div class="col-md-12 text-center mt-3">
                <p>Additional items available.</p>
            </div>
        @endif
    </div>
</section>


<!-- team member -->
{{-- 
<section class="container-fluid teammember py-5 mt-4">
    <div class="container">
        <div class="row d-flex flex-column justify-content-center align-items-center ">
            <div class="col-lg-5">
                <h1 class="md-text text-center">Core team member</h1>
                <p class=" extra-small-text text-center">Utilizing her exceptional experience and knowledge of
                    the luxury waterfront markets, Simone serves an extensive and elite worldwide client base. </p>
            </div>
            <div class="col-lg-12 extradiv">
                <div class="row d-flex justify-content-center align-items-center gap-1 teamimagerow">

                    @foreach ($teams as $team)

                        <div class="col-md-3 member-container">


                            <img class="teamimage" src="{{ asset($team->image) }}" alt="Blog image" data-src="">
                            <div class="memberdetail">
                                <h1 class="xs-text">{{$team->name}}</h1>
                                <h1 class="extra-small-text1">{{$team->position}}</h1>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section> --}}




<!-- more team member -->

<section class="container-fluid  py-5 mb-4">
    <div class="container">
        <div class="row d-flex flex-column justify-content-center align-items-center">
            <div class="col-lg-5">
                <h1 class="md-text text-center"> our team member</h1>
                <p class=" extra-small-text text-center">Utilizing her exceptional experience and knowledge of
                    the luxury waterfront markets, Simone serves an extensive and elite worldwide client base. </p>
            </div>
            <div class="col-lg-12">
                <div class="row d-flex justify-content-center align-items-center py-2">
                    @foreach ($teams as $team)
                        <div class="col-md-3 member-container">
                            <img class="teamimage" src="{{ asset($team->image) }}" alt="Blog image" data-src="">
                            <div class="memberdetail">
                                <h1 class="xs-text">{{$team->name}}</h1>
                                <h1 class="extra-small-text1">{{$team->position}}</h1>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- testimonial -->
<section class="container-fluid teammember py-5 my-4">
    <div class="container">
        <div class="row d-flex flex-column justify-content-center align-items-center">
            <div class="col-lg-5">
                <h1 class="md-text text-center"> TESTIMONIALS</h1>
                <p class=" extra-small-text text-center">Utilizing her exceptional experience and knowledge of
                    the luxury waterfront markets, Simone serves an extensive and elite worldwide client base. </p>
            </div>
            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    @foreach ($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="card  customcard col-md-12 ">
                                <strong class="mb-2 text-success">
                                    <img src="{{asset('image/dash.png')}}" alt="">
                                </strong>
                                <h3 class="mb-0 md-text">
                                    {{ $testimonial->title}}
                                </h3>
                                <p class="sm-text mb-auto ">
                                    {{ strlen($testimonial->review) > 400 ? substr($testimonial->review, 0, 400) . "..." : $testimonial->review}}
                                </p>
                                <div class="d-flex  pt-2">
                                    <img class=" " data-src="holder.js/200x250?theme=thumb" alt=""
                                        src="{{asset('image/blog.png')}}"
                                        style="height:12vh; width:100px ;border-radius:8px;" />
                                    <div class="mx-4">
                                        <div class="md-text media-md-text "> {{ $testimonial->title}}</div>
                                        <div class="sm-text"> {{ $testimonial->stitle}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>



<!---------------------------------------------------- faq ------------------------------------------------------------->
<section class="container-fluid py-5">
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <div class="col-lg-5">
            <h1 class="md-text text-center">Frequently Asked Questions</h1>
            <p class="extra-small-text text-center">
                Utilizing her exceptional experience and knowledge of
                the luxury waterfront markets, Simone serves an extensive and elite worldwide client base.
            </p>
        </div>
        <div class="col-lg-12">
            <div class="row d-flex align-items-center justify-content-center">
                @foreach($faqs as $faq)
                <div class="col-12 col-md-8 mb-3">
                    <div class="accordion" id="accordion{{ $loop->index }}">
                        <div class="accordion-item">
                            <h2 class="accordion-header " id="heading{{ $loop->index }}">
                                <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $loop->index }}" aria-expanded="false"
                                    aria-controls="collapse{{ $loop->index }}">
                                    <p class="sm-text">{{ $faq->question }} ?</p>
                                </button>
                            </h2>
                            <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse"
                                aria-labelledby="heading{{ $loop->index }}"
                                data-bs-parent="#accordion{{ $loop->index }}">
                                <div class="accordion-body ">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection