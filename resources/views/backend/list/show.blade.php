@extends('backend.template.main')

@section('title', $loker->title)

@push('css')
<style>
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loading-content {
    text-align: center;
}

.d-none {
    display: none !important;
}
</style>
@endpush

@section('content')
{{-- Overlay Loading --}}
<div id="loadingOverlay" class="loading-overlay d-none">
    <div class="loading-content">
        <div class="spinner-border text-white mb-3" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
        <h4 class="text-white">Sedang mengirim lamaran...</h4>
        <p class="text-white">Mohon tunggu dan jangan tutup halaman ini.</p>
    </div>
</div>

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
            <li class="breadcrumb-item"><a href="{{ route('panel.list.index') }}">List Loker</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $loker->title }}</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Detail Loker: {{ $loker->title }}</h1>
            <p class="mb-0">Perusahaan: {{ $loker->company_name }}</p>
        </div>
        <div>
            <a href="{{ route('panel.list.index') }}" class="btn btn-outline-gray-600 d-inline-flex align-items-center">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>
</div>

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h1 class="card-title display-4">{{ $loker->title }}</h1>
                        <h6 class="card-subtitle mb-4">{{ $loker->company_name }} <i class="far fa-circle-check"></i>
                        </h6>
                        <p class="card-text"><i class="fas fa-building"></i> {{ $loker->position }}</p>
                        <p class="card-text"><i class="fas fa-money-bill"></i>
                            Rp. {{ number_format($loker->salary_range_min, 0, ',', '.') }} -
                            Rp. {{ number_format($loker->salary_range_max, 0, ',', '.') }} /bulan</p>
                        <p class="card-text"><i class="fas fa-clock"></i>
                            @if ($loker->type == 'full-time')
                            Full time
                            @elseif ($loker->type == 'part-time')
                            Part time
                            @elseif ($loker->type == 'contract')
                            Kontrak
                            @elseif ($loker->type == 'internship')
                            Magang
                            @endif
                        </p>
                        <p class="card-text"><i class="fas fa-location-dot"></i> {{ $loker->location }}</p>
                        <p class="card-text">Posted {{ $loker->created_at->locale('id')->diffForHumans() }}</p>
                        @if($hasApplied)
                            <button class="btn btn-secondary" @disabled(true)>Already Applied</button>
                        @else
                            <button id="applyButton" class="btn btn-success text-white"
                                onclick="handleApply('{{ $loker->uuid }}')" @if(!$hasCompleteProfile)
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Lengkapi profile/data Anda terlebih dahulu"
                                @endif>
                                Apply Now
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h5>Job Description</h5>
                <p>{!! nl2br(e($loker->description)) !!}</p>
                <h5>Requirements</h5>
                <p>{!! nl2br(e($loker->requirements)) !!}</p>
                <h5>Company Questions</h5>
                <p>{!! nl2br(e($loker->questions)) !!}</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function handleApply(uuid) {
    // Show loading overlay
    document.getElementById('loadingOverlay').classList.remove('d-none');

    fetch(`/panel/list/${uuid}/apply`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        // Hide loading overlay
        document.getElementById('loadingOverlay').classList.add('d-none');

        if (data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                showConfirmButton: false,
                timer: 1000
            }).then(() => {
                window.location.reload();
            });
        } else {
            if (data.redirect) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Profile Belum Lengkap',
                    text: data.message,
                    showCancelButton: true,
                    confirmButtonText: 'Lengkapi Profile',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = data.redirect;
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message
                });
            }
        }
    })
    .catch(error => {
        // Hide loading overlay even if there's an error
        document.getElementById('loadingOverlay').classList.add('d-none');

        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Terjadi kesalahan! Silakan coba lagi.'
        });
    });
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>
@endpush
