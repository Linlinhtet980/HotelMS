@extends('layout.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Overview')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admincss/dashboard/index.css') }}">
@endpush

@section('content')
<div class="dashboard-section">
    <h2 class="section-title">Projects</h2>
    <div class="project-grid">
        <div class="project-card">
            <h4 class="project-name">Main Platform</h4>
            <div class="status-pill success">
                <i class="fa-solid fa-check"></i>
                <span>All services are up and running</span>
            </div>
        </div>
        <div class="project-card">
            <h4 class="project-name">Experimental</h4>
            <div class="status-pill success">
                <i class="fa-solid fa-check"></i>
                <span>All services are up and running</span>
            </div>
        </div>
        <a href="{{ route('rooms.create') }}" class="project-card create-dashed">
            <i class="fa-solid fa-plus"></i>
            <span>Create new project</span>
        </a>
    </div>
</div>

<div class="dashboard-section mt-10">
    <h2 class="section-title">Rooms & Services</h2>
    <div class="tabs-container">
        <div class="tabs">
            <button class="tab active">Active ({{ $stats['total_rooms'] }})</button>
            <button class="tab">Available ({{ $stats['available_rooms'] }})</button>
            <button class="tab">All</button>
        </div>
    </div>
    
    <div class="table-responsive mt-4">
        <table class="hotel-table minimalist">
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>NAME <i class="fa-solid fa-arrow-down-short-wide"></i></th>
                    <th>STATUS</th>
                    <th>TYPE</th>
                    <th>CAPACITY</th>
                    <th>PRICE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentBookings as $booking)
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <div class="service-name">
                            <i class="fa-solid fa-globe"></i>
                            <span class="link-text">{{ $booking->customer_name }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="status-dot-badge success">
                            <i class="fa-solid fa-circle"></i> Deployed
                        </span>
                    </td>
                    <td>Room #{{ $booking->room->Room_Number ?? 'N/A' }}</td>
                    <td>2 Person</td>
                    <td>{{ $booking->price }}</td>
                    <td class="text-right"><i class="fa-solid fa-ellipsis"></i></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
