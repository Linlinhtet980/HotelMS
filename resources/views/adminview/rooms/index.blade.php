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
    <a href="{{ route('rooms.create') ?? '#' }}" class="btn-primary">
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
                        <th>Amenities</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
@php /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Room[] $rooms */ @endphp

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
                            <div class="amenity-badges" style="display: flex; flex-wrap: wrap; gap: 4px;">
                                @forelse($room->amenities as $amenity)
                                    <span class="status-badge" style="background-color: rgba(124, 58, 237, 0.1); color: var(--accent-gold); border: 1px solid rgba(124, 58, 237, 0.2); padding: 2px 8px; font-size: 0.75rem;">
                                        {{ $amenity->name }}
                                    </span>
                                @empty
                                    <span class="text-secondary" style="font-size: 0.8rem;">No amenities</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="action-links">
                                <a href="{{ route('rooms.show', $room->id) }}" class="action-btn view-btn" title="View">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('rooms.edit', $room->id) }}" class="action-btn edit-btn" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
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

@push('scripts')
    <script src="{{ asset('js/rooms/room_actions.js') }}"></script>
@endpush
