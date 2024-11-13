@extends('backend.template.main')

@section('title', 'Detail Jadwal Interview')

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
            <li class="breadcrumb-item"><a href="{{ route('panel.jadwal-interview.pelamar.index') }}">Jadwal Interview</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Interview</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Detail Jadwal Interview: {{ $interview->application->applicant->profile->full_name }}</h1>
            <p class="mb-0">Status Interview:
                @if ($interview->status == 'scheduled')
                    <span class="badge bg-warning text-black">Dijadwalkan</span>
                @elseif ($interview->status == 'completed')
                    <span class="badge bg-success">Selesai</span>
                @elseif ($interview->status == 'cancelled')
                    <span class="badge bg-danger">Dibatalkan</span>
                @endif
            </p>
        </div>
    </div>
</div>

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <h5>Posisi yang Dilamar</h5>
        <p>{{ $interview->application->jobdesc->title }}</p>

        <h5>Bidang</h5>
        <p>{{ $interview->application->jobdesc->position }}</p>

        <h5>Perusahaan</h5>
        <p>{{ $interview->application->jobdesc->company_name }}</p>

        <h5>Tanggal Interview</h5>
        <p>{{ \Carbon\Carbon::parse($interview->interview_date)->translatedFormat('d F Y H:i') }}</p>

        <h5>Metode Interview</h5>
        <p>
            @switch($interview->interview_method)
                @case('online')
                    <span class="badge bg-black">Online</span>
                    @break
                @case('offline')
                    <span class="badge bg-gray-500">Offline</span>
                    @break
            @endswitch
        </p>

        <h5>Lokasi Interview</h5>
        <p>{{ $interview->interview_location ?? 'Tidak ada lokasi' }}</p>

        <h5>Nama Pewawancara</h5>
        <p>{{ $interview->interviewer_name }}</p>

        <h5>Catatan Tambahan</h5>
        <p>{{ $interview->notes ?? 'Tidak ada catatan' }}</p>
    </div>
</div>
@endsection
