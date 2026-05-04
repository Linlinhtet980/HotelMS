@extends('layout.admin')

@section('title', 'Amenities List')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admincss/amenitycss/index.css') }}">
@endpush

@section('content')
    <div class="page-header">
        <div class="header-left">
            <div class="page-title-group">
                <i class="fa-solid fa-list-check"></i>
                <h1 class="page-title">All <span class="text-secondary">Amenities</span></h1>
            </div>
            <div class="total-badge">
                {{ count($amenities) }} Total
            </div>
        </div>
        <div class="header-right">
            <a href="{{ route('Amenities.create') }}" class="btn-primary">
                <i class="fa-solid fa-plus"></i> Add Amenity
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="hotel-table minimalist">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Amenity Name</th>
                        <th>Attached Rooms</th>
                        <th>Created At</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($amenities as $amenity)
                    <tr>
                        <td>#{{ $amenity->id }}</td>
                        <td>
                            <div class="amenity-name">
                                <div class="amenity-icon">
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <span>{{ $amenity->name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge status-info">
                                <i class="fa-solid fa-door-open"></i> {{ $amenity->rooms_count }} Rooms
                            </span>
                        </td>
                        <td>{{ $amenity->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="action-links">
                                <a href="{{ route('Amenities.edit', $amenity->id) }}" class="action-link edit-link">Edit</a>
                                <form action="{{ route('Amenities.destroy', $amenity->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-link delete-link" style="background:none; border:none; padding:0; cursor:pointer;" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="fa-solid fa-box-open"></i>
                            <p>No amenities found. Add your first one!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
