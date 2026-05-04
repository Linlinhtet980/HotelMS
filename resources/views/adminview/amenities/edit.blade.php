@extends('layout.admin')

@section('title', 'Edit Amenity')
@section('page_title', 'Edit Amenity')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admincss/amenitycss/form.css') }}">
@endpush

@section('content')
<div class="form-container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa-solid fa-pen-to-square"></i> Update Amenity Details</h3>
            <a href="{{ route('Amenities.index') }}" class="btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Back to List
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('Amenities.update', $Amenity->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Amenity Name</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-tag"></i>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. Free Wi-Fi" value="{{ old('name', $Amenity->name) }}" required autofocus>
                    </div>
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('Amenities.index') }}" class="btn btn-outline">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-check"></i> Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
