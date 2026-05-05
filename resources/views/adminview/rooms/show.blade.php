@extends('layout.admin')

@section('title', 'Room Details')
@section('page_title', 'Room View')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admincss/roomcss/show.css') }}">
@endpush

@section('content')
<div class="detail-container">
    <div class="actions-header" style="justify-content: flex-start; margin-bottom: 2rem;">
    <a href="{{ route('rooms.index') }}" class="btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Back to Rooms List
    </a>
    </div>

    <!-- Main Detail Card -->
    <div class="detail-card">
        <!-- Let side: Image Placeholer -->
        <div class="detail-image-section">
            <img src="{{ $room->image ? asset('storage/' . $room->image) : 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?q=80&w=2070&auto=format&fit=crop' }}" alt="Luxury Hotel Room" class="room-image">
            <div class="image-overlay-badge">
                <i class="fa-solid fa-star"></i>
                <span>Premium Quality</span>
            </div>
        </div>

        <!-- Right Side: Details Configuration -->
        <div class="detail-content-section">
            
            <div class="detail-header">
                <div class="room-title-group">
                    <h2 class="room-number-large">
                        <i class="fa-solid fa-door-open"></i>
                        {{ $room->Room_Number }}
                    </h2>
                    <div class="room-price-large">
                        ${{ number_format($room->price, 2) }} <span>/ night</span>
                    </div>
                </div>
            </div>

            <div class="detail-list">
                <!-- Bed Type -->
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fa-solid fa-bed"></i>
                    </div>
                    <div class="detail-info">
                        <span class="detail-label">Bed Type Configuration</span>
                        <span class="detail-value">{{ $room->detail && $room->detail->bed_type ? ucfirst($room->detail->bed_type) . ' Bed' : 'Not Specified' }}</span>
                    </div>
                </div>


                <!-- Amenities -->
                <div class="detail-item full-width" style="margin-top: 1rem;">
                    <div class="detail-icon" style="background-color: rgba(124, 58, 237, 0.1); color: var(--accent-gold);">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <div class="detail-info">
                        <span class="detail-label">Available Amenities</span>
                        <div class="amenities-list-show" style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px;">
                            @forelse($room->amenities as $amenity)
                                <span class="amenity-item" style="background: #111; border: 1px solid #222; padding: 6px 12px; border-radius: 6px; font-size: 0.85rem; color: #EEE; display: flex; align-items: center; gap: 8px;">
                                    <i class="fa-solid fa-check" style="color: var(--accent-gold); font-size: 0.7rem;"></i>
                                    {{ $amenity->name }}
                                </span>
                            @empty
                                <span class="text-secondary" style="font-size: 0.9rem;">No specific amenities listed for this room.</span>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Example of an extra field just to make it look full and nice -->
                <div class="detail-item">
                    <div class="detail-icon" style="background-color: rgba(16, 185, 129, 0.1); color: #10B981;">
                        <i class="fa-solid fa-broom"></i>
                    </div>
                    <div class="detail-info">
                        <span class="detail-label">Room Status</span>
                        <span class="detail-value" style="color: #10B981;">Ready / Cleaned</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons Footer -->
            <div class="detail-actions" style="display: flex; gap: 1rem; margin-top: 2rem;">
                <a href="{{ route('rooms.edit', $room->id) }}" class="btn-primary" style="flex: 1;">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Room Info
                </a>
                
                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="flex: 1;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger" style="width: 100%;" onclick="return confirm('Are you sure you want to delete this room?');">
                        <i class="fa-solid fa-trash"></i> Delete Room
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endsection
