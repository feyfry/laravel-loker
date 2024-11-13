@extends('backend.template.main')

@section('title', 'Jadwal Interview')

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
            <li class="breadcrumb-item active" aria-current="page">Jadwal Interview</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Jadwal Interview</h1>
            <p class="mb-0">Jadwal Interview Akan Tampil Jika Ada Lamaran Yang Diterima</p>
        </div>
    </div>
</div>

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0 rounded">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start">#</th>
                        <th class="border-0">Posisi</th>
                        <th class="border-0">Tanggal Interview</th>
                        <th class="border-0">Metode</th>
                        <th class="border-0">Status</th>
                        <th class="border-0 rounded-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($interviews as $interview)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $interview->application->jobdesc->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($interview->interview_date)->translatedFormat('d F Y H:i') }}</td>
                        <td>
                            @switch($interview->interview_method)
                            @case('online')
                            <span class="badge bg-black">Online</span>
                            @break
                            @case('offline')
                            <span class="badge bg-gray-500">Offline</span>
                            @break
                            @endswitch
                        </td>
                        <td>
                            @switch($interview->status)
                            @case('scheduled')
                            <span class="badge bg-warning text-black">Dijadwalkan</span>
                            @break
                            @case('completed')
                            <span class="badge bg-success">Selesai</span>
                            @break
                            @case('cancelled')
                            <span class="badge bg-danger">Dibatalkan</span>
                            @break
                            @endswitch
                        </td>
                        <td>
                            <a href="{{ route('panel.jadwal-interview.pelamar.show', $interview->uuid) }}"
                                @if($interview->status == 'scheduled')
                                    class="btn btn-sm btn-warning"
                                @elseif ($interview->status == 'completed')
                                    class="btn btn-sm btn-success text-white"
                                @elseif ($interview->status == 'cancelled')
                                    class="btn btn-sm btn-danger"
                                @endif
                                >
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada jadwal interview</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $interviews->links() }}
        </div>
    </div>
</div>
@endsection
