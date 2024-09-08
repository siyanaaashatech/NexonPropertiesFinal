@extends("frontend.layouts.master")
@section("content")
<section class="container-fluid singleprojectpage">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-8 pb-2">
                        <img src="{{ asset('image/bighouse.png') }}" alt="" class="imagecontroller">
                    </div>
                    <!-- Property Images -->
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 mb-3 pt-0 mt-0">
                                <div class="propertype-subimage">
                                    <img src="{{asset('image/bighouse.png')}}" alt="Beautiful house"
                                        class="img-fluid rounded">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="propertype-subimage">
                                    <img src="{{asset('image/bighouse.png')}}" alt="Spacious home"
                                        class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="d-flex py-2">
                        <div class="btn-buttonxs  btn-buttonxsgreen mx-1">For Sell</div>
                        <div class="btn-buttonxs btn-buttonxsgreen">Active</div>
                    </div>
                    <h3 class="md-text">Modern Office For Rent</h3>
                    <h4 class="sm-text"><i class="fa-solid fa-location-dot"></i> <span>kathmandu ,nepal</span></h4>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="description-body">
                                <h3 class="md-text greenhighlight">overview</h3>
                                <div class="d-flex justify-content-between flex-wrap">
                                    <div class=" ">
                                        <h3 class="sm-text des-text">update</h3>
                                        <h2 class="sm-text">june,2023</h2>
                                    </div>
                                    <div class=" ">
                                        <h3 class="sm-text des-text">house type</h3>
                                        <h2 class="sm-text">residential</h2>
                                    </div>
                                    <div class=" ">
                                        <h3 class="sm-text des-text">bedroom</h3>
                                        <h2 class="sm-text">12</h2>
                                    </div>
                                    <div class=" ">
                                        <h3 class="sm-text des-text">bathroom</h3>
                                        <h2 class="sm-text">04</h2>
                                    </div>
                                    <div class=" ">
                                        <h3 class="sm-text des-text">size</h3>
                                        <h2 class="sm-text">400 meter</h2>
                                    </div>
                                    <div class=" ">
                                        <h3 class="sm-text des-text">other</h3>
                                        <h2 class="sm-text">june,2023</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="description-body">
                                <h3 class="md-text greenhighlight">description</h3>
                                <p class="sm-text">
                                    Just steps away from QM2 express bus to Manhattan and local buses; only minutes from
                                    the LIRR.
                                    Walking
                                    distance to the Bay Terrace Shopping Center, Baybridge Commons Shopping Center, pool
                                    clubs, movie
                                    theaters and tennis courts. 1.5 blocks away from elementary school PS 169 and Bell
                                    Academy middle
                                    school in the award-winning District 25. Don’t miss this opportunity!
                                </p>

                            </div>
                            <div class="description-body">
                                <h3 class="md-text greenhighlight">more information if any</h3>
                                <p class="sm-text">
                                    Just steps away from QM2 express bus to Manhattan and local buses; only minutes from
                                    the LIRR.
                                    Walking
                                    distance to the Bay Terrace Shopping Center, Baybridge Commons Shopping Center, pool
                                    clubs, movie
                                    theaters and tennis courts. 1.5 blocks away from elementary school PS 169 and Bell
                                    Academy middle
                                    school in the award-winning District 25. Don’t miss this opportunity!
                                </p>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="description-body">
                                <h3 class="md-text greenhighlight">nexon detail center</h3>
                                <div class="d-flex flex-column gap-2">
                                    <input type="text" name="" id="" class="input" placeholder="Person name" />
                                    <input type="text" name="" id="" class="input" placeholder="Contact NO."
                                        class="my-2" />
                                    <textarea name="" id="" class="textarea"></textarea>
                                    <button class="btn-buttongreen btn-buttonygreenlarge mx-2">Search</button>
                                </div>
                            </div>
                            <div class="paddingbox nobackground description-body">
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
            </div>
        </div>
</section>

@endsection