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
                                    <th>Status</th>
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
                                        <td>{{ ucfirst($review->status) }}</td>
                                        <td>
                                            @if($review->status === 'pending')
                                                <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button type="submit" class="btn btn-outline-success btn-sm">Accept</button>
                                                </form>
                                                <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">Reject</button>
                                                </form>
                                            @else
                                                {{ ucfirst($review->status) }}
                                            @endif
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



