
@extends("frontend.layouts.master")


@section('content')
<section class="container-fluid py-4">
    <div class="container">
        <h1 class="lg-text1 text-center">Search Results</h1>

        @if($properties->isNotEmpty())
            <div class="row mt-4">
                @foreach ($properties as $property)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @php
                                $mainImages = !empty($property->main_image) ? json_decode($property->main_image, true) : [];
                                $mainImage = !empty($mainImages) ? asset($mainImages[0]) : asset('images/default-placeholder.png');
                            @endphp
                            <img src="{{ $mainImage }}" alt="Property Image" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $property->title }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($property->description, 100) }}</p>
                                <p class="card-text"><strong>Location:</strong> {{ $property->street }}, {{ $property->suburb }}, {{ $property->state }}</p>
                                <p class="card-text"><strong>Price:</strong> ${{ number_format($property->price, 2) }}</p>
                                <p class="card-text"><strong>Bedrooms:</strong> {{ $property->bedrooms }}</p>
                                <a href="{{ route('singleproperties', ['id' => $property->id]) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center mt-4">No properties found matching your search criteria.</p>
        @endif
    </div>
</section>
@endsection
