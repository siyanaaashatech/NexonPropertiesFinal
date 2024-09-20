@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Reviews and Ratings</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($reviews->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Reviews</th>
                                    <th>Ratings</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ e($review->name) }}</td>
                                        <td>{{ e($review->email) }}</td>
                                        <td>{{ e(Str::limit($review->reviews, 50)) }}</td>
                                        <td>{{ $review->ratings }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewReviewModal{{ $review->id }}">
                                                View
                                            </button>

                                            <div class="modal fade" id="viewReviewModal{{ $review->id }}" tabindex="-1" aria-labelledby="viewReviewModalLabel{{ $review->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="viewReviewModalLabel{{ $review->id }}">Review from {{ e($review->name) }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Email:</strong> {{ e($review->email) }}</p>
                                                            <p><strong>Rating:</strong> {{ $review->ratings }} / 5</p>
                                                            <p><strong>Review:</strong> {{ e($review->reviews) }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            No Reviews available.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection