@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Properties List</h4>
                    <a href="{{ route('property.create') }}" class="btn btn-primary float-end">Add New Property</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($properties->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Amenities</th>
                                    <th>Price</th>
                                    <th>Update Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($properties as $index => $property)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $property->title }}</td>
                                        <td>{{ $property->category->title }}</td>
                                        <td>{{ $property->subCategory->title }}</td>
                                        <td>
                                            @if(is_array($property->amenities) && count($property->amenities) > 0)
                                                @foreach($property->amenities as $amenityId)
                                                    @php
                                                        $amenity = App\Models\Amenity::find($amenityId);
                                                    @endphp
                                                    @if($amenity)
                                                       {{ $amenity->title }}
                                                    @endif
                                                @endforeach
                                            @else
                                                <span class="text-muted">No amenities</span>
                                            @endif
                                        </td>
                                        <td>${{ number_format($property->price, 2) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($property->update_time)->format('Y - F - d') }}</td>
                                        <td>
                                            @if($property->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('property.edit', $property->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('property.destroy', $property->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this property?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>

                                            <!-- Button to trigger Metadata Modal -->
                                            @if($property->metadata)
                                                <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#metadataModal{{ $property->id }}">
                                                    M
                                                </button>

                                                <!-- Metadata Modal with Edit Form -->
                                                <div class="modal fade" id="metadataModal{{ $property->id }}" tabindex="-1" aria-labelledby="metadataModalLabel{{ $property->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="metadataModalLabel{{ $property->id }}">Edit Metadata Details</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('metadata.update', $property->metadata->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="form-group mb-3">
                                                                        <label for="meta_title">Meta Title</label>
                                                                        <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ old('meta_title', $property->metadata->meta_title) }}" required>
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label for="meta_description">Meta Description</label>
                                                                        <textarea name="meta_description" id="meta_description" class="form-control" rows="3" required>{{ old('meta_description', $property->metadata->meta_description) }}</textarea>
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label for="meta_keywords">Meta Keywords</label>
                                                                        <textarea name="meta_keywords" id="meta_keywords" class="form-control" rows="3" required>{{ old('meta_keywords', $property->metadata->meta_keywords) }}</textarea>
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label for="slug">Slug</label>
                                                                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $property->metadata->slug) }}" required>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            No properties available. <a href="{{ route('property.create') }}">Create a new property</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection