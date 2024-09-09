
@extends("frontend.layouts.master")
@section("content")

  <!-- bannersection -->
  <section class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="carousel-inner mb-3">
                    <div class="row d-flex">
                        <div
                            class="col-md-12 text-center d-flex flex-column justify-content-center align-items-center mb-2 ">
                            <img src="{{ asset('image/abou1.png') }}" alt="" srcset=""
                                class="imagecontroller imagecontrollerheight">
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

    <section class="container-fluid companydescription">
        <div class="container">
            <div class="row d-flex flex-column justify-content-center align-items-center">
                <div class="col-md-5">
                    <h1 class="md-text text-center">more about us </h1>
                    <p class=" extra-small-text text-center">Utilizing her exceptional experience and knowledge of
                        the luxury waterfront markets, Simone serves an extensive and elite worldwide client base. </p>
                </div>
                <div class="col-md-12">
                    <div class="row d-flex  align-items-center justify-content-center gap-1">
                        <div class="col-md-5">
                            <h1 class="md-text text-center">our vision </h1>
                            <p class=" extra-small-text text-center">Utilizing her exceptional experience and knowledge
                                of
                                the luxury waterfront markets, Simone serves an extensive and elite worldwide client
                                base. </p>
                        </div>
                        <div class="col-md-5">
                            <h1 class="md-text text-center">0ur Mission </h1>
                            <p class=" extra-small-text text-center">Utilizing her exceptional experience and knowledge
                                of
                                the luxury waterfront markets, Simone serves an extensive and elite worldwide client
                                base. </p>
                        </div>
                        <div class="col-md-5">
                            <h1 class="md-text text-center">our Values</h1>
                            <p class=" extra-small-text text-center">Utilizing her exceptional experience and knowledge
                                of
                                the luxury waterfront markets, Simone serves an extensive and elite worldwide client
                                base. </p>
                        </div>
                        <div class="col-md-5">
                            <h1 class="md-text text-center">our Resource </h1>
                            <p class=" extra-small-text text-center">Utilizing her exceptional experience and knowledge
                                of
                                the luxury waterfront markets, Simone serves an extensive and elite worldwide client
                                base. </p>
                        </div>
                    </div>


                </div>

            </div>


        </div>
    </section>

    <!-- team member -->

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
                        <div class="col-md-3 member-container">
                            <img class="teamimage" data-src="" alt="" src="{{asset('image/member1.png')}}" />
                            <div class="memberdetail">
                                <h1 class="xs-text">animesh baral</h1>
                                <h1 class="extra-small-text1">front-end developer</h1>
                            </div>

                        </div>
                        <div class="col-md-3 member-container">
                            <img class="teamimage" data-src="" alt="" src="{{asset('image/member2.png')}}" />
                            <div class="memberdetail">
                                <h1 class="xs-text">animesh baral</h1>
                                <h1 class="extra-small-text1">front-end developer</h1>
                            </div>
                        </div>


                        <div class="col-md-3 member-container">
                            <img class="teamimage" data-src="" alt="" src="{{asset('image/member2.png')}}" />
                            <div class="memberdetail">
                                <h1 class="xs-text">animesh baral</h1>
                                <h1 class="extra-small-text1">front-end developer</h1>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>




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
                        <div class="col-md-3 member-container">
                            <img class="teamimage" data-src="" alt="" src="{{asset('image/member1.png')}}" />
                            <div class="memberdetail">
                                <h1 class="xs-text">animesh baral</h1>
                                <h1 class="extra-small-text1">front-end developer</h1>
                            </div>

                        </div>
                        <div class="col-md-3 member-container">
                            <img class="teamimage" data-src="" alt="" src="{{asset('image/member2.png')}}" />
                            <div class="memberdetail">
                                <h1 class="xs-text">animesh baral</h1>
                                <h1 class="extra-small-text1">front-end developer</h1>
                            </div>
                        </div>

                        <div class="col-md-3 member-container">
                            <img class="teamimage" data-src="" alt="" src="{{asset('image/member1.png')}}" />
                            <div class="memberdetail">
                                <h1 class="xs-text">animesh baral</h1>
                                <h1 class="extra-small-text1">front-end developer</h1>
                            </div>

                        </div>
                        <div class="col-md-3 member-container">
                            <img class="teamimage" data-src="" alt="" src="{{asset('image/member2.png')}}" />
                            <div class="memberdetail">
                                <h1 class="xs-text">animesh baral</h1>
                                <h1 class="extra-small-text1">front-end developer</h1>
                            </div>
                        </div>
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
                                {{ strlen($testimonial->description) >400 ? substr($testimonial->description, 0, 400) . "..." : $testimonial->description}}
                            </p>

                            <div class="d-flex  pt-2">
                                <img class=" " data-src="holder.js/200x250?theme=thumb" alt=""
                                    src="{{asset('image/blog.png')}}" style="height:10vh; width:80px ;border-radius:8px;" />
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



















    <section class="container-fluid py-5 ">
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <div class="col-lg-5">
                <h1 class="md-text text-center"> Frequently Asked Questions</h1>
                <p class=" extra-small-text text-center">Utilizing her exceptional experience and knowledge of
                    the luxury waterfront markets, Simone serves an extensive and elite worldwide client base. </p>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="accordion accordion-flush" id="accordionFlushExample1">
                            <div class="accordion-item my-2 py-2">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        <b> What types of items/properties do you offer for rent?</b>
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample1">
                                    <div class="accordion-body">
                                        MWe offer a diverse range of rental items, including [list specific items, e.g.,
                                        cars, apartments, equipment]. For a complete list, please visit our
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item my-2 py-2">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                        aria-controls="flush-collapseTwo">
                                        <b> How do I make a reservation?</b>
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample1">
                                    <div class="accordion-body">
                                        You can make a reservation online through our website, by calling our customer
                                        service, or visiting our office. Visit our [reservation page/link] for more
                                        details.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item my-2 py-2">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThree" aria-expanded="false"
                                        aria-controls="flush-collapseThree">
                                        <b>What is the minimum rental period? </b>
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample1">
                                    <div class="accordion-body">
                                        minimum rental period varies by item. For most items, the minimum is [e.g., one
                                        day, one week]. Check the specific item’s details on our website for exact
                                        information
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item my-2 py-2">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseFour" aria-expanded="false"
                                        aria-controls="flush-collapseFour">
                                        <b> Can I extend my rental period?</b>
                                    </button>
                                </h2>
                                <div id="flush-collapseFour" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample1">
                                    <div class="accordion-body">
                                        Yes, you can extend your rental period based on availability. Please contact us
                                        as soon as possible to arrange the extension and ensure availability.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item my-2 py-2">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseFive" aria-expanded="false"
                                        aria-controls="flush-collapseFive">
                                        <b> What are your payment options?</b>
                                    </button>
                                </h2>
                                <div id="flush-collapseFive" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample1">
                                    <div class="accordion-body">
                                        We accept [list payment options, e.g., credit/debit cards, PayPal, bank
                                        transfers]. Payments can be made online or at our office.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="accordion accordion-flush" id="accordionFlushExample2">
                            <div class="accordion-item my-2 py-2">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseSix" aria-expanded="false"
                                        aria-controls="flush-collapseSix">
                                        <b> How is the rental price determined?</b>
                                    </button>
                                </h2>
                                <div id="flush-collapseSix" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample2">
                                    <div class="accordion-body">
                                        Rental prices are based on [e.g., the type of item, rental duration, season].
                                        Additional fees may apply for extra services or late returns.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item my-2 py-2">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseSeven" aria-expanded="false"
                                        aria-controls="flush-collapseSeven">
                                        <b>Are there any additional fees?</b>
                                    </button>
                                </h2>
                                <div id="flush-collapseSeven" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample2">
                                    <div class="accordion-body">
                                        Additional fees may include [e.g., late return fees, cleaning fees, security
                                        deposits]. All fees will be outlined in your rental agreement.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item my-2 py-2">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseEight" aria-expanded="false"
                                        aria-controls="flush-collapseEight">
                                        <b>Do you offer discounts or promotions?</b>
                                    </button>
                                </h2>
                                <div id="flush-collapseEight" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample2">
                                    <div class="accordion-body">
                                        Yes, we offer various discounts and promotions throughout the year. Check our
                                        [website/promotions page] for current offers.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item my-2 py-2">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseNine" aria-expanded="false"
                                        aria-controls="flush-collapseNine">
                                        <b>What is your cancellation policy?</b>
                                    </button>
                                </h2>
                                <div id="flush-collapseNine" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample2">
                                    <div class="accordion-body">
                                        Cancellations can be made up to [number] hours/days before the scheduled pickup
                                        time. Cancellation fees may apply. Refer to our [cancellation policy page] for
                                        details.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

  

    <script>

        function changepage(element) {
            const pageli = document.getElementsByClassName("nextli");
            for (let i = 0; i < pageli.length; i++) {
                pageli[i].classList.remove("activeli");

            }

            element.classList.add("activeli")
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
