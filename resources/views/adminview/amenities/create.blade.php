@extends('layout.admin')

@section('title', 'Add New Amenity')
@section('page_title', 'Create Amenity')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admincss/amenitycss/form.css') }}">
@endpush

@section('content')
<div class="form-container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa-solid fa-plus-circle"></i> New Amenity Details</h3>
            <a href="{{ route('Amenities.index') }}" class="btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Back to List
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('Amenities.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Amenity Name</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-tag"></i>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. Free Wi-Fi, Swimming Pool" value="{{ old('name') }}" required autofocus>
                    </div>
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="reset" class="btn-secondary">Reset Form</button>
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-save"></i> Save Amenity
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
