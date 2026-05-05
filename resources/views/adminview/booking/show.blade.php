@extends('layout.admin')

@section('title', 'Booking Details')
@section('page_title', 'Reservation Details')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admincss/bookingcss/show.css') }}">
@endpush

@section('content')
<div class="invoice-container">
    <div class="actions-header" style="justify-content: flex-start; margin-bottom: 1.5rem;">
    <a href="{{ route('bookings.index') }}" class="btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Back to List
    </a>
    </div>

    <div class="invoice-card">
        <!-- Header Section -->
        <div class="invoice-header">
            <div class="brand-details">
                <h2>Grand Regency</h2>
                <p>Luxury Hotel & Resort</p>
                <p>123 Elegance Blvd, Royal City</p>
            </div>
            <div class="invoice-meta">
                <div class="invoice-id">BOOKING #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</div>
                <p style="margin-bottom: 1rem;">Date: {{ $booking->created_at ? $booking->created_at->format('M d, Y') : 'N/A' }}</p>

                <span class="status-badge status-{{ $booking->status }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>
        </div>

        <div class="invoice-body">
            <!-- Customer & Room Info Grid -->
            <div class="info-grid">
                <!-- Customer Section -->
                <div class="info-section">
                    <h4>Customer Information</h4>
                    <div class="info-content">
                        <div class="info-row">
                            <span class="info-label">Name:</span>
                            <span class="info-value">{{ $booking->customer_name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Phone:</span>
                            <span class="info-value">{{ $booking->customer_phone }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Guest ID:</span>
                            <span class="info-value">G-{{ 1000 + $booking->id }}</span>
                        </div>
                    </div>
                </div>

                <!-- Room Section -->
                <div class="info-section">
                    <h4>Room Information</h4>
                    <div class="info-content">
                        <div class="info-row">
                            <span class="info-label">Room Number:</span>
                            <span class="info-value">Room {{ $booking->room->Room_Number ?? 'N/A' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Bed Type:</span>
                            <span class="info-value">{{ ucfirst($booking->room->detail->bed_type ?? 'Standard') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Price per Night:</span>
                            <span class="info-value">${{ number_format($booking->room->price ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Billing Details -->
            <div class="info-section">
                <h4>Reservation Summary</h4>
                <table class="billing-table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Dates</th>
                            <th>Stay Duration</th>
                            <th style="text-align: right;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nights = \Carbon\Carbon::parse($booking->check_in_date)->diffInDays($booking->check_out_date) ?: 1;
                        @endphp
                        <tr>
                            <td>
                                <strong>Accommodation Charge</strong><br>
                                <small style="color: var(--text-secondary)">Standard stay rate for Room {{ $booking->room->Room_Number ?? 'N/A' }}</small>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($booking->check_in_date)->format('M d, Y') }} - 
                                {{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d, Y') }}
                            </td>
                            <td>{{ $nights }} Night{{ $nights > 1 ? 's' : '' }}</td>
                            <td style="text-align: right; font-weight: 600;">
                                ${{ number_format($booking->total_price, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border-bottom: none;"></td>
                            <td class="total-label" style="border-bottom: none;">Total Amount</td>
                            <td class="total-amount" style="text-align: right; border-bottom: none;">
                                ${{ number_format($booking->total_price, 2) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="invoice-footer">
            <div class="footer-note">
                <i class="fa-solid fa-circle-info"></i> This is a computer-generated summary for internal records.
            </div>
            <div class="action-btns">
                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn-primary" style="padding: 0.5rem 1.5rem;">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Booking
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
