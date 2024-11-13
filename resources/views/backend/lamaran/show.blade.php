@extends('backend.template.main')

@section('title', 'Detail Lamaran Kerja: ' . $lamaran->applicant->profile->full_name)

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
            <li class="breadcrumb-item"><a href="{{ route('panel.lamaran.index') }}">Kelola Lamaran</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $lamaran->jobdesc->position }}</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Detail Lamaran Kerja: {{ $lamaran->applicant->profile->full_name }}</h1>
            <p class="mb-0">Posisi: {{ $lamaran->jobdesc->title }} - {{ $lamaran->jobdesc->company_name }}</p>
        </div>
        <div>
            <a href="{{ route('panel.lamaran.index') }}"
                class="btn btn-outline-gray-600 d-inline-flex align-items-center">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>
</div>

{{-- table --}}
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    @php
                    $imageExists = $lamaran->applicant->profile->image &&
                    Storage::disk('public')->exists($lamaran->applicant->profile->image);
                    $resumeExists = $lamaran->applicant->profile->resume &&
                    Storage::disk('public')->exists($lamaran->applicant->profile->resume);
                    @endphp

                    @if ($imageExists)
                    <div class="m-3 align-items-center text-center justify-content-center">
                        <a href="{{ asset('storage/' . $lamaran->applicant->profile->image) }}" target="_blank">
                            <img src="{{ asset('storage/' . $lamaran->applicant->profile->image) }}" alt=""
                                class="img-fluid rounded" width="15%">
                        </a>
                    </div>
                    @else
                    <div class="m-3">
                        <p>Gambar Tidak Ditemukan</p>
                    </div>
                    @endif

                    <div class="dropdown-divider"></div>

                    <div class="card-body">
                        <div class="mb-1 table-responsive">
                            <h1 class="display-5 pt-2 pb-3">Detail Pelamar</h1>
                            <table class="table table-striped text-break">
                                <tr>
                                    <th>Nama Pelamar:</th>
                                    <td>{{ $lamaran->applicant->profile->full_name }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir:</th>
                                    <td>{{ $lamaran->applicant->profile->date_of_birth }}</td>
                                </tr>
                                <tr>
                                    <th>No.HP:</th>
                                    <td>{{ $lamaran->applicant->profile->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat:</th>
                                    <td>{{ $lamaran->applicant->profile->address }}</td>
                                </tr>
                                <tr>
                                    <th>Pendidikan:</th>
                                    <td>{{ $lamaran->applicant->profile->education }}</td>
                                </tr>
                                <tr>
                                    <th>Pengalaman:</th>
                                    <td>{{ $lamaran->applicant->profile->experience }}</td>
                                </tr>
                                <tr>
                                    <th>Keahlian:</th>
                                    <td>{{ $lamaran->applicant->profile->skills }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if ($lamaran->status == 'pending')
                                        <span class="badge bg-warning text-black">Pending</span>
                                        @elseif($lamaran->status == 'reviewed')
                                        <span class="badge bg-info">Direview</span>
                                        @elseif($lamaran->status == 'accepted')
                                        <span class="badge bg-success">Diterima</span>
                                        @else
                                        <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Melamar:</th>
                                    <td>{{ date('d M Y H:i', strtotime($lamaran->created_at . '+7 hours')) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>

                    <div class="card-body">
                        <div class="mb-1 table-responsive">
                            <h1 class="display-5 pt-2 pb-3">Detail Lamaran</h1>
                            <table class="table table-striped text-break">
                                <tr>
                                    <th>Posisi Pekerjaan:</th>
                                    <td>{{ $lamaran->jobdesc->title }}</td>
                                </tr>
                                <tr>
                                    <th>Perusahaan:</th>
                                    <td>{{ $lamaran->jobdesc->company_name }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi:</th>
                                    <td>{{ $lamaran->jobdesc->location }}</td>
                                </tr>
                                <tr>
                                    <th>Bidang:</th>
                                    <td>{{ $lamaran->jobdesc->position }}</td>
                                </tr>
                                <tr>
                                    <th>Tipe Pekerjaan:</th>
                                    <td>{{ $lamaran->jobdesc->type }}</td>
                                </tr>
                                <tr>
                                    <th>Gaji:</th>
                                    <td>Rp. {{ number_format($lamaran->jobdesc->salary_range_min, 0, ',', '.') }}
                                        -
                                        Rp.
                                        {{ number_format($lamaran->jobdesc->salary_range_max, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi Pekerjaan:</th>
                                    <td>{{ $lamaran->jobdesc->description }}</td>
                                </tr>
                                <tr>
                                    <th>Persyaratan:</th>
                                    <td>{{ $lamaran->jobdesc->requirements }}</td>
                                </tr>
                                <tr>
                                    <th>Pertanyaan:</th>
                                    <td>{{ $lamaran->jobdesc->questions }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>

                    <div class="card-body">
                        <div class="mb-1">
                            @if ($resumeExists)
                            <div class="mt-1">
                                <div class="p-2 badge bg-success text-white rounded-pill">
                                    <a href="{{ asset('storage/' . $lamaran->applicant->profile->resume) }}"
                                        target="_blank">
                                        <i class="fa-solid fa-eye"></i> Lihat CV/Resume
                                    </a>
                                </div>
                            </div>
                            @else
                            <div class="m-3">
                                <p class="text-danger">CV/Resume Tidak Ditemukan</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
