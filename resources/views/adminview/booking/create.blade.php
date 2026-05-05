@extends('layout.admin')

@section('title', 'New Booking')
@section('page_title', 'Create New Reservation')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admincss/bookingcss/create_form.css') }}">
@endpush

@section('content')
<div class="form-container">
    <div class="actions-header" style="justify-content: flex-start; margin-bottom: 1.5rem;">
    <a href="{{ route('bookings.index') }}" class="btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Back to List
    </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fa-solid fa-calendar-plus"></i> Reservation Details
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    
                    <!-- Customer Name -->
                    <div class="form-group @error('customer_name') has-error @enderror">
                        <label for="customer_name" class="form-label">Customer Name <span>*</span></label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" placeholder="Full Name" required>
                        </div>
                        @error('customer_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Customer Phone -->
                    <div class="form-group @error('customer_phone') has-error @enderror">
                        <label for="customer_phone" class="form-label">Phone Number <span>*</span></label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-phone"></i>
                            <input type="text" class="form-control" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="09xxxxxxxxx" required>
                        </div>
                        @error('customer_phone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Room Selection -->
                    <div class="form-group @error('room_id') has-error @enderror">
                        <label for="room_id" class="form-label">Select Room <span>*</span></label>
                        <select class="form-select" id="room_id" name="room_id" onchange="calculatePrice()" required>

                            <option value="" disabled selected>Choose a room...</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" data-price="{{ $room->price }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                    Room {{ $room->Room_Number }} - ${{ number_format($room->price, 2) }}/night
                                </option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group @error('status') has-error @enderror">
                        <label for="status" class="form-label">Booking Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Check In Date -->
                    <div class="form-group @error('check_in_date') has-error @enderror">
                        <label for="check_in_date" class="form-label">Check-In Date <span>*</span></label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-calendar-day"></i>
                            <input type="date" class="form-control" id="check_in_date" name="check_in_date" onchange="calculatePrice()" value="{{ old('check_in_date', date('Y-m-d')) }}" required>

                        </div>
                        @error('check_in_date')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Check Out Date -->
                    <div class="form-group @error('check_out_date') has-error @enderror">
                        <label for="check_out_date" class="form-label">Check-Out Date <span>*</span></label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-calendar-check"></i>
                            <input type="date" class="form-control" id="check_out_date" name="check_out_date" onchange="calculatePrice()" value="{{ old('check_out_date', date('Y-m-d', strtotime('+1 day'))) }}" required>

                        </div>
                        @error('check_out_date')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <!-- Price Summary -->
                <div class="summary-card">
                    <div class="summary-title">
                        <i class="fa-solid fa-file-invoice-dollar"></i> Price Summary
                    </div>
                    <div class="summary-item">
                        <span class="label">Price per Night:</span>
                        <span class="value" id="summary-price-night">$0.00</span>
                    </div>
                    <div class="summary-item">
                        <span class="label">Total Nights:</span>
                        <span class="value" id="summary-nights">0 nights</span>
                    </div>
                    <div class="summary-item total-row">
                        <span class="label">Grand Total:</span>
                        <span class="value" id="summary-total">$0.00</span>
                    </div>
                    <input type="hidden" name="total_price" id="total_price_input">
                </div>

                <div class="form-actions">
                    <button type="reset" class="btn-secondary">
                        <i class="fa-solid fa-rotate-left"></i> Reset
                    </button>
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-check"></i> Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function calculatePrice() {
        let price = document.getElementById('room_id').selectedOptions[0].dataset.price || 0;
        let nights = Math.ceil((new Date(document.getElementById('check_out_date').value) - new Date(document.getElementById('check_in_date').value)) / 86400000) || 1;
        let total = nights * price;

        document.getElementById('summary-price-night').innerText = `$${parseFloat(price).toFixed(2)}`;
        document.getElementById('summary-nights').innerText = `${nights} nights`;
        document.getElementById('summary-total').innerText = `$${total.toFixed(2)}`;
        document.getElementById('total_price_input').value = total.toFixed(2);
    }


    // Initial run
    window.onload = calculatePrice;

</script>
@endpush
