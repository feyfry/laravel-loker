@extends('backend.template.main')

@section('title', 'Notifikasi')

@section('content')
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('panel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Notifikasi</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Notifikasi</h1>
            <p class="mb-0">Semua notifikasi Anda</p>
        </div>
        @if($notifications->where('is_read', false)->count() > 0)
        <div>
            <button type="button" class="btn btn-sm btn-gray-800" id="markAllAsRead">
                <i class="fas fa-check-double me-2"></i> Tandai Semua Dibaca
            </button>
        </div>
        @endif
    </div>
</div>

<div class="card border-0 shadow">
    <div class="card-body">
        <div class="list-group list-group-flush">
            @forelse($notifications as $notification)
            <div class="list-group-item list-group-item-action {{ $notification->is_read ? 'bg-gray-50' : 'bg-gray-100' }} border-bottom">
                <a href="{{ $notification->link }}"
                    class="notification-item"
                    data-uuid="{{ $notification->uuid }}"
                    style="text-decoration: none; color: inherit;">

                    <div class="row align-items-center">
                        <!-- Icon berdasarkan tipe -->
                        <div class="col-auto">
                            @switch($notification->type)
                                @case('lamaran')
                                    <div class="icon-shape icon-sm bg-primary text-white rounded-circle">
                                        <i class="fas fa-file-alt ms-1"></i>
                                    </div>
                                    @break
                                @case('interview')
                                    <div class="icon-shape icon-sm bg-info text-white rounded-circle">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    @break
                                @case('status_lamaran')
                                    @if ($notification->data['status'] == 'reviewed')
                                        <div class="icon-shape icon-sm bg-info text-white rounded-circle">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    @elseif ($notification->data['status'] == 'accepted')
                                        <div class="icon-shape icon-sm bg-success text-white rounded-circle">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    @else
                                        <div class="icon-shape icon-sm bg-danger text-white rounded-circle">
                                            <i class="fas fa-times ms-1"></i>
                                        </div>
                                    @endif
                                    @break
                                @default
                                    <div class="icon-shape icon-sm bg-gray-500 text-white rounded-circle">
                                        <i class="fas fa-bell"></i>
                                    </div>
                            @endswitch
                        </div>
                        <!-- Konten Notifikasi -->
                        <div class="col ps-0 ms-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="h6 mb-0">{{ $notification->title }}</h4>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted">
                                        {{ $notification->created_at->locale('id')->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                            <p class="font-small mt-1 mb-0">
                                {{ $notification->message }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="text-center py-4 mt-4">
                <h4 class="text-gray-500">Tidak ada notifikasi</h4>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $notifications->links() }}
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .notification-item:hover {
        background-color: rgba(0,0,0,0.05);
        transition: background-color 0.2s ease;
    }

    .icon-shape {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {
    // Tandai notifikasi sebagai dibaca saat diklik
    $('.notification-item').click(function(e) {
        const uuid = $(this).data('uuid');
        $.ajax({
            url: `/panel/notifications/${uuid}/read`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    // Tandai semua notifikasi sebagai dibaca
    $('#markAllAsRead').click(function() {
        $.ajax({
            url: '/panel/notifications/read-all',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function() {
                window.location.reload();
            }
        });
    });
});
</script>
@endpush
