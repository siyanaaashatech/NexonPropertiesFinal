{{-- <!-- about --> --}}
<section class="container-fluid about gapbetweensection indexaboutsection"
    style="background-image: url('{{ asset('image/backimage.jpg') }}');">
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <div class="row py-4">
            <div class="col-md-6 d-flex">

                <div class="image col-md-6 first">
                    @php
                        // Check if $aboutuss->image is a string before decoding
                        if (is_string($aboutuss->image)) {
                            $images = json_decode($aboutuss->image, true);
                            if (json_last_error() !== JSON_ERROR_NONE) {
                                $images = []; // Handle JSON decode error
                            }
                        } elseif (is_array($aboutuss->image)) {
                            // If it's already an array, use it directly
                            $images = $aboutuss->image;
                        } else {
                            $images = []; // Fallback to an empty array if neither
                        }
                    @endphp

                    @if (!empty($images) && isset($images[0]))
                        <img src="{{ asset('storage/aboutus/' . basename($images[0])) }}" alt="aboutus">
                    @else
                        <p>No image available</p>
                    @endif
                </div>

                <div class="image col-md-6 my-2 mx-1 second">
                    @if (!empty($images) && isset($images[1]))
                        <img src="{{ asset('storage/aboutus/' . basename($images[1])) }}" alt="aboutus">
                    @else
                        <p>No image available</p>
                    @endif
                </div>
            </div>

            <div class="col-md-5 mx-md-4">
                <div class="title">
                    <div class="xs-text dashline">{{ $aboutuss->subtitle }}</div>
                    <div class="lg-text1">{{ $aboutuss->title }}</div>
                </div>
                <p class="sm-text1">{!! Str::substr($aboutuss->description, 0, 500) !!}</p>
            </div>
        </div>
    </div>
</section>
