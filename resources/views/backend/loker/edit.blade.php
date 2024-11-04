@extends('backend.template.main')

@section('title', 'Edit Lowongan Kerja')

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
            <li class="breadcrumb-item active" aria-current="page">Edit Loker</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Edit Loker</h1>
            <p class="mb-0">Perbarui Data Lowongan Kerja</p>
        </div>
        <div>
            <a href="{{ route('panel.loker.index') }}" class="btn btn-outline-gray-600 d-inline-flex align-items-center">
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

{{-- form --}}
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <form action="{{ route('panel.loker.update', $loker->uuid) }}" method="post">
            @method('PUT')
            @csrf

            <div class="mb-3">
                <label for="posted_by">Diposting Oleh</label>
                <select name="posted_by" id="posted_by" class="form-control @error('posted_by') is-invalid @enderror">
                    <option value="" hidden>--- Dipublikasikan oleh ---</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }} " {{ old('posted_by', $loker->posted_by) == $user->id ? 'selected' : '' }}>
                        {{ $user->full_name }}</option>
                    @endforeach
                </select>

                @error('posted_by')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="title">Posisi Pekerjaan</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $loker->title) }}">

                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="company_name">Nama Perusahaan</label>
                <input type="text" name="company_name" id="company_name"
                    class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name', $loker->company_name) }}">

                @error('company_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location">Lokasi</label>
                <input type="text" name="location" id="location"
                    class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $loker->location) }}">

                @error('location')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="position">Bidang</label>
                <input type="text" name="position" id="position"
                    class="form-control @error('position') is-invalid @enderror" value="{{ old('position', $loker->position) }}">

                @error('position')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type">Tipe Pekerjaan</label>
                <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                    <option value="" hidden>--- Pilih Tipe ---</option>
                    <option value="full-time" {{ old('type', $loker->type) == 'full-time' ? 'selected' : '' }}>Full time</option>
                    <option value="part-time" {{ old('type', $loker->type) == 'part-time' ? 'selected' : '' }}>Part time</option>
                    <option value="contract" {{ old('type', $loker->type) == 'contract' ? 'selected' : '' }}>Kontrak</option>
                    <option value="internship" {{ old('type', $loker->type) == 'internship' ? 'selected' : '' }}>Magang</option>
                </select>

                @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="salary_range">Gaji</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="number" name="salary_range_min" id="salary_range_min"
                        class="form-control @error('salary_range_min') is-invalid @enderror"
                        value="{{ old('salary_range_min', $loker->salary_range_min) }}" placeholder="Min">
                    <div class="input-group-prepend"></div>
                    <span class="input-group-text">-</span>
                    <input type="number" name="salary_range_max" id="salary_range_max"
                        class="form-control @error('salary_range_max') is-invalid @enderror"
                        value="{{ old('salary_range_max', $loker->salary_range_max) }}" placeholder="Max">
                </div>

                @error('salary_range_min')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                @error('salary_range_max')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>

            <div class="mb-3">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" cols="30" rows="10"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $loker->description) }}</textarea>

                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="requirements">Requirements</label>
                <textarea name="requirements" id="requirements" cols="30" rows="10"
                    class="form-control @error('requirements') is-invalid @enderror">{{ old('requirements', $loker->requirements) }}</textarea>

                @error('requirements')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="questions">Pertanyaan</label>
                <textarea name="questions" id="questions" cols="30" rows="10"
                    class="form-control @error('questions') is-invalid @enderror">{{ old('questions', $loker->questions) }}</textarea>

                @error('questions')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="" hidden>--- Pilih Status ---</option>
                    <option value="open" {{ old('status', $loker->status) == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="closed" {{ old('status', $loker->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>

                @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="float-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
