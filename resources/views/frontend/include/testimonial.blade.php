<section class="container-fluid container-fluid-background">
    <div class="container d-flex flex-column justify-content-center align-items-center">
      <div class="title py-2">
        <div class="xs-text dashline">Trusted Real estate Care</div>
        <div class="lg-text1">Testimonials we give</div>
      </div>
      <div class="content-body d-md-flex justify-content-center align-items-center pt-3">
        <div class="col-md-8">
          <div class="card flex-md-row  box-shadow px-1 py-4" id="graacard">
            <div class="img-container col-md-5">
              <img class="img-fluid" data-src="holder.js/200x250?theme=thumb" alt=""
                src="{{asset('image/bighouse.png')}}" />
            </div>


            <div class="card-body d-flex flex-column col-md-6">
              <strong class="mb-2 text-success">
                <img src="{{asset('image/dash.png')}}" alt="">

              </strong>
              <h3 class="mb-0 md-text">
                proffesional $ personal
              </h3>
              <p class="sm-text mb-auto ">TWe wanted to take a moment to tell you what a pleasure it has been to work
                with you and your team at Al Asar. Your team professionalism has been by far beyond industry Firms and
                even ourexpectations.
                It's a pleasure to work with a firm which not only understands and commodes customers request but a</p>
              <div class="d-flex  pt-2">
                <img class=" " data-src="holder.js/200x250?theme=thumb" alt="" src="{{asset('image/blog.png')}}"
                  style="height:10vh; width:80px ;border-radius:8px;" />
                <div class="mx-4">
                  <div class="md-text media-md-text ">Anil Thapa Magar</div>
                  <div class="sm-text">software developer</div>
                </div>
              </div>

            </div>

          </div>
        </div>
        <div class="col-md-2 mx-md-4 d-flex gap-2 pt-2">
          <button class="next-button" id="forward"><i class="fa-solid fa-arrow-right " onclick="funChangeCard(1)"></i></button>
          <button class="next-button" id="backward"><i class="fa-solid fa-arrow-left " onclick="funChangeCard(-1)"></i></button>

        </div>

      </div>

    </div>
  </section>