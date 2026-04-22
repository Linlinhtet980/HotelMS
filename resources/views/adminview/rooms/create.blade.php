@extends('layout.admin')

@section('title', 'Add New Room')
@section('page_title', 'Add New Room')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admincss/roomcss/create_form.css') }}">
@endpush

@section('content')
<div class="form-container">
    <div class="actions-header" style="justify-content: flex-start; margin-bottom: 1.5rem;">
        <a href="{{ route('rooms.index') ?? '#' }}" class="btn btn-outline" style="padding: 0.5rem 1rem;">
            <i class="fa-solid fa-arrow-left"></i> Back to Rooms
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fa-solid fa-bed"></i> Room Details
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    
                    <!-- Room Number -->
                    <div class="form-group @error('Room_Number') has-error @enderror">
                        <label for="Room_Number" class="form-label">Room Number <span>*</span></label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-door-open"></i>
                            <input type="text" class="form-control" id="Room_Number" name="Room_Number" value="{{ old('Room_Number') }}" placeholder="e.g. 101, 204A" required>
                        </div>
                        @error('Room_Number')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="form-group @error('price') has-error @enderror">
                        <label for="price" class="form-label">Price per Night ($) <span>*</span></label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-dollar-sign"></i>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="0.00" required>
                        </div>
                        @error('price')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Bed Type -->
                    <div class="form-group @error('bed_type') has-error @enderror">
                        <label for="bed_type" class="form-label">Bed Type <span>*</span></label>
                        <select class="form-select" id="bed_type" name="bed_type" required>
                            <option value="" disabled selected>Select Bed Type</option>
                            <option value="single" {{ old('bed_type') == 'single' ? 'selected' : '' }}>Single Bed</option>
                            <option value="double" {{ old('bed_type') == 'double' ? 'selected' : '' }}>Double Bed</option>
                            <option value="queen" {{ old('bed_type') == 'queen' ? 'selected' : '' }}>Queen Size</option>
                            <option value="king" {{ old('bed_type') == 'king' ? 'selected' : '' }}>King Size</option>
                            <option value="twin" {{ old('bed_type') == 'twin' ? 'selected' : '' }}>Twin Beds</option>
                        </select>
                        @error('bed_type')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Wi-Fi Status -->
                    <div class="form-group @error('has_wifi') has-error @enderror">
                        <label class="form-label">Wi-Fi Availability</label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" class="radio-input" name="has_wifi" value="1" {{ old('has_wifi', '1') == '1' ? 'checked' : '' }}>
                                Yes, Available
                            </label>
                            <label class="radio-label">
                                <input type="radio" class="radio-input" name="has_wifi" value="0" {{ old('has_wifi') == '0' ? 'checked' : '' }}>
                                No Wi-Fi
                            </label>
                        </div>
                        @error('has_wifi')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Room Image Upload -->
                    <div class="form-group full-width @error('image') has-error @enderror">
                        <label for="image" class="form-label">Room Image</label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-image"></i>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" style="padding-top: 0.65rem;">
                        </div>
                        @error('image')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="form-actions">
                    <button type="reset" class="btn btn-outline" style="border-color: var(--text-secondary); color: var(--text-secondary);">
                        <i class="fa-solid fa-rotate-left"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i> Save Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
