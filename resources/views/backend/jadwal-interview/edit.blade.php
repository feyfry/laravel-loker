@extends('backend.template.main')

@section('title', 'Edit Jadwal Interview')

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
            <li class="breadcrumb-item"><a href="{{ route('panel.jadwal-interview.index') }}">Kelola Interview</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Jadwal Interview</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Edit Jadwal Interview: {{ $interview->application->applicant->profile->full_name }}</h1>
            <p class="mb-0">Perbarui Data Jadwal Interview</p>
        </div>

        <div>
            <a href="{{ route('panel.jadwal-interview.index') }}"
                class="btn btn-outline-gray-600 d-inline-flex align-items-center">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>
</div>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <form action="{{ route('panel.jadwal-interview.update', $interview->uuid) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="application_id">Pilih Pelamar</label>
                        <select name="application_id" id="application_id" class="form-control" required>
                            <option value="" hidden>-- Pilih Pelamar --</option>
                                @foreach($applications as $application)
                                <option value="{{ old('application_id', $application->id) }}"
                                    {{ old('application_id', $interview->application_id) == $application->id ? 'selected' : '' }}>
                                    {{ $application->applicant->profile->full_name }} -
                                    {{ $application->jobdesc->title }}
                                </option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="interview_date">Tanggal Interview</label>
                        <input type="datetime-local" name="interview_date" id="interview_date" class="form-control"
                            value="{{ old('interview_date', \Carbon\Carbon::parse($interview->interview_date)->format('Y-m-d\TH:i')) }}"
                            required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="interview_method ">Metode Interview</label>
                <select name="interview_method" id="interview_method" class="form-control" required>
                    <option value="offline" {{ old('interview_method', $interview->interview_method) == 'offline' ? 'selected' : '' }}>
                        Offline
                    </option>
                    <option value="online" {{ old('interview_method', $interview->interview_method) == 'online' ? 'selected' : '' }}>
                        Online</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status">Status Interview</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="scheduled" {{ old('status', $interview->status) == 'scheduled' ? 'selected' : '' }}>
                        Dijadwalkan</option>
                    <option value="completed" {{ old('status', $interview->status) == 'completed' ? 'selected' : '' }}>
                        Selesai</option>
                    <option value="cancelled" {{ old('status', $interview->status) == 'cancelled' ? 'selected' : '' }}>
                        Dibatalkan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="interview_location">Lokasi Interview (opsional)
                    <sub class="text-muted text-danger text-italic">(Untuk Metode Interview: Offline &  Online | berupa alamat fisik atau link zoom, dll.)</sub>
                </label>
                <input type="text" name="interview_location" id="interview_location" class="form-control"
                    value="{{ old('interview_location', $interview->interview_location) }}">
            </div>
            <div class="mb-3">
                <label for="interviewer_name">Nama Pewawancara</label>
                <input type="text" name="interviewer_name" id="interviewer_name" class="form-control"
                    value="{{ old('interviewer_name', $interview->interviewer_name) }}" required>
            </div>
            <div class="mb-3">
                <label for="notes">Catatan Tambahan (opsional)
                    <sub class="text-muted text-danger text-italic">(Untuk catatan tambahan)</sub>
                </label>
                <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes', $interview->notes) }}</textarea>
            </div>

            <div class="float-end">
                <button type="submit" class="btn btn-primary">Update Jadwal</button>
            </div>
        </form>
    </div>
</div>
@endsection
