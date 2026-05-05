@extends('layout.admin')

@section('title', 'Bookings Management')
@section('page_title', 'Bookings List')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admincss/bookingcss/index.css') }}">
@endpush

@section('content')
<div class="actions-header">
    <div class="search-bar">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" class="search-input" placeholder="Search by customer or room...">
    </div>
    <a href="{{ route('bookings.create') }}" class="btn-primary">
        <i class="fa-solid fa-plus"></i> New Booking
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-calendar-days"></i> All Reservations
        </h3>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="hotel-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Room</th>
                        <th>Dates</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td>
                            <div class="customer-info">
                                <span class="customer-name">{{ $booking->customer_name }}</span>
                                <span class="customer-phone">{{ $booking->customer_phone }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="room-ref">
                                <i class="fa-solid fa-door-open"></i>
                                <span>Room {{ $booking->room->Room_Number ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="date-info">
                                <span class="date-label">Check In</span>
                                <span>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('M d, Y') }}</span>
                                <span class="date-label" style="margin-top: 5px;">Check Out</span>
                                <span>{{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d, Y') }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="booking-price">${{ number_format($booking->total_price, 2) }}</span>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $booking->status }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="action-links">
                                <a href="{{ route('bookings.show', $booking->id) }}" class="action-btn view-btn" title="View">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('bookings.edit', $booking->id) }}" class="action-btn edit-btn" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn" style="background:none; border:none; padding:0; cursor:pointer;" onclick="return confirm('Are you sure?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fa-solid fa-calendar-xmark"></i>
                                <h3>No Bookings Found</h3>
                                <p>There are no reservations to display at the moment.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
