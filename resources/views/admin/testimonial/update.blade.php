@extends('admin.layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Edit Testimonial</h1>
        </div>
        <!-- /.card-header -->

        <!-- form start -->
        <form method="POST" action="{{ route('testimonials.update', $testimonial->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ $testimonial->title }}" required>
                </div>

                <div class="form-group">
                    <label for="designation">Designation</label>
                    <input type="text" name="designation" class="form-control" id="designation" value="{{ $testimonial->designation }}">
                </div>

                <div class="form-group">
                    <label for="review">Review</label>
                    <textarea name="review" class="form-control" id="review" rows="4" required>{{ $testimonial->review }}</textarea>
                </div>

                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="number" name="rating" class="form-control" id="rating" min="1" max="5" value="{{ $testimonial->rating }}" required>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="1" {{ $testimonial->status ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$testimonial->status ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Testimonial</button>
            </div>
        </form>
    </div>
@endsection
