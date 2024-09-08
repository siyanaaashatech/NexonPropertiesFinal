<section class="container-fluid container-fluid-background gapbetweensection">
    <div class="container  d-flex flex-column justify-content-center align-items-center">
      <div class="title">
        <div class="xs-text dashline">Trusted Real estate Care</div>
        <div class="lg-text1">Testimonials we give</div>
      </div>
      <div class="content-body d-md-flex justify-content-center align-items-center pt-3">
        <div class="col-md-8">
          @foreach ($services as $service )
          <div class="card flex-md-row box-shadow  py-4 testimonialcard" id="grabcard">
            <div class="row px-4 rounded">
            <div class="img-container col-md-5">
              <img  data-src="holder.js/200x250?theme=thumb" alt=""
                src="{{asset('image/bighouse.png')}}" />
            </div>
            <div class="card-body d-flex flex-column col-md-6">
              <strong class="mb-2 text-success">
                <img src="{{asset('image/dash.png')}}" alt="">

              </strong>
              <h3 class="mb-0 md-text">
                {{$service -> title}}
              </h3>
              <p class="sm-text mb-auto ">
              {{ strlen($service -> description)>200 ? substr($service -> description, 0,300) ."..." : ($service -> description)}}
              </p>
              <div class="d-flex  pt-2">
                <img class=" " data-src="holder.js/200x250?theme=thumb" alt="" src="{{asset('image/blog.png')}}"
                  style="height:10vh; width:80px ;border-radius:8px;" />
                <div class="mx-4">
                  <div class="md-text media-md-text ">{{$service -> title}}</div>
                  <div class="sm-text">{{$service -> title}}</div>
                </div>
              </div>

            </div>
            </div>

          </div>

          @endforeach

        </div>
        <div class="col-md-2 mx-md-4 d-flex gap-2 pt-2">
          <button class="next-button" id="forward" onclick="forward()"><i class="fa-solid fa-arrow-right " ></i></button>
          <button class="next-button" id="backward" onclick="backward()"><i class="fa-solid fa-arrow-left " ></i></button>

        </div>

      </div>

    </div>
  </section>


<script>
  document.addEventListener("DOMContentLoaded", function() {
    const cards = Array.from(document.querySelectorAll("#grabcard")); // Select all testimonial cards
    const forwardButton = document.getElementById("forward");
    const backwardButton = document.getElementById("backward");
    let currentIndex = 0;

    function updateDisplay() {
        cards.forEach((card, index) => {
            card.style.display = (index === currentIndex) ? 'block' : 'none';
        });
    }

    function forward() {
        if (currentIndex < cards.length - 1) {
            currentIndex++;
            updateDisplay();
        }
    }

    function backward() {
        if (currentIndex > 0) {
            currentIndex--;
            updateDisplay();
        }
    }

    forwardButton.addEventListener("click", forward);
    backwardButton.addEventListener("click", backward);

    // Initial display setup
    updateDisplay();
});

</script>