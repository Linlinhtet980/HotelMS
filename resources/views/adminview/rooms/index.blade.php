@extends('layout.admin')

@section('title', 'Rooms Management')
@section('page_title', 'Rooms List')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admincss/roomcss/index.css') }}">
@endpush

@section('content')
<div class="actions-header">
    <div class="search-bar">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" class="search-input" placeholder="Search room number or type...">
    </div>
    <a href="{{ route('rooms.create') ?? '#' }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Add New Room
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-bed"></i> All Rooms
        </h3>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="hotel-table">
                <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>Bed Type</th>
                        <th>Price (per night)</th>
                        <th>Wi-Fi Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
@php /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\rooms[] $rooms */ @endphp

                    @forelse($rooms as $room)
                    <tr>
                        <td>
                            <div class="room-number">
                                <div class="room-icon">
                                    <i class="fa-solid fa-door-closed"></i>
                                </div>
                                {{ $room->Room_Number }}
                            </div>
                        </td>
                        <td>
                            @if($room->detail && $room->detail->bed_type)
                                <span class="status-badge status-info">{{ ucfirst($room->detail->bed_type) }}</span>
                            @else
                                <span class="text-secondary">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="room-price">${{ number_format($room->price, 2) }}</span>
                        </td>
                        <td>
                            @if($room->detail && $room->detail->has_wifi)
                                <span class="status-badge status-success"><i class="fa-solid fa-wifi" style="margin-right: 4px;"></i> Available</span>
                            @else
                                <span class="status-badge status-danger"><i class="fa-solid fa-wifi" style="margin-right: 4px; text-decoration: line-through;"></i> Not Available</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-links">
                                <a href="{{ route('rooms.show', $room->id) }}" class="btn-icon view-btn" title="View Details">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('rooms.edit', $room->id) }}" class="btn-icon edit-btn" title="Edit Room">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon delete-btn" title="Delete Room" onclick="return confirm('Are you sure you want to delete this room?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fa-solid fa-box-open"></i>
                                <h3>No Rooms Available</h3>
                                <p>Start by adding your first hotel room.</p>
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
