@extends('backend.template.main')

@section('title', 'Loker: ' . $loker->title)

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
            <li class="breadcrumb-item"><a href="{{ route('panel.loker.index') }}">Loker</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $loker->title }}</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Loker: {{ $loker->title }}</h1>
            <p class="mb-0">Loker: {{ $loker->title }} {{ $loker->company_name }}</p>
        </div>
        <div>
            <a href="{{ route('panel.loker.index') }}"
                class="btn btn-outline-gray-600 d-inline-flex align-items-center">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>
</div>

{{-- table --}}
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped text-break">
                <tr>
                    <th class="border-0 rounded-start">Diposting Oleh</th>
                    <td class="border-0">{{ $users ? $users->full_name : 'Tidak diketahui' }}</td>
                </tr>
                <tr>
                    <th class="border-0 rounded-start">Posisi Pekerjaan</th>
                    <td class="border-0">{{ $loker->title }}</td>
                </tr>
                <tr>
                    <th class="border-0 rounded-start">Nama Perusahaan</th>
                    <td class="border-0">{{ $loker->company_name }}</td>
                </tr>
                <tr>
                    <th class="border-0">Lokasi</th>
                    <td class="border-0">{{ $loker->location }}</td>
                </tr>
                <tr>
                    <th class="border-0">Bidang</th>
                    <td class="border-0">{{ $loker->position }}</td>
                </tr>
                <tr>
                    <th class="border-0">Tipe Pekerjaan</th>
                    <td class="border-0">{{ $loker->type }}</td>
                </tr>
                <tr>
                    <th class="border-0">Gaji</th>
                    <td class="border-0">Rp. {{ number_format($loker->salary_range_min, 0, ',', '.') }} - Rp.
                        {{ number_format($loker->salary_range_max, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="border-0">Deskripsi</th>
                    <td class="border-0">{!! nl2br(e($loker->description)) !!}</td>
                </tr>
                <tr>
                    <th class="border-0">Requirements</th>
                    <td class="border-0">{!! nl2br(e($loker->requirements)) !!}</td>
                </tr>
                <tr>
                    <th class="border-0">Pertanyaan dari Perusahaan</th>
                    <td class="border-0">{!! nl2br(e($loker->questions)) !!}</td>
                </tr>
                <tr>
                    <th class="border-0">Status</th>
                    <td class="border-0">{{ $loker->status }}</td>
                </tr>
                <tr>
                    <th class="border-0">Dibuat</th>
                    <td class="border-0">{{ date('d-m-Y H:i:s', strtotime($loker->created_at . '+7 hours')) }}</td>
                </tr>
                <tr>
                    <th class="border-0">Diperbarui</th>
                    <td class="border-0">{{ date('d-m-Y H:i:s', strtotime($loker->updated_at . '+7 hours')) }}</td>
                </tr>
            </table>
        </div>

        <div class="float-end mt-2">
            <a href="{{ route('panel.loker.edit', $loker->uuid) }}" class="btn btn-warning"><i class="fas fa-edit"></i>
                Edit</a>
        </div>
    </div>
</div>
@endsection
