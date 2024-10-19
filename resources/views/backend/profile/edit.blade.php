@extends('backend.template.main')

@section('title', 'Edit Profile')

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
            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Edit Profile</h1>
            <p class="mb-0">Isi data profile</p>
        </div>
        <div>
            <a href="{{ route('panel.dashboard') }}" class="btn btn-outline-gray-600 d-inline-flex align-items-center">
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

{{-- form --}}
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <form action="{{ route('panel.profile.update') }}" method="post">
            @method('PUT')
            @csrf

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="full_name">Nama Lengkap</label>
                        <input type="text" name="full_name" id="full_name"
                            class="form-control @error('full_name') is-invalid @enderror"
                            value="{{ old('full_name', $profile->full_name) }}">

                        @error('full_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="date_of_birth">Tanggal lahir</label>
                        <input type="date" name="date_of_birth" id="date_of_birth"
                            class="form-control @error('date_of_birth') is-invalid @enderror"
                            value="{{ old('date_of_birth', $profile->date_of_birth) }}">

                        @error('date_of_birth')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="phone_number">No. HP</label>
                        <input type="number" name="phone_number" id="phone_number"
                            class="form-control @error('phone_number') is-invalid @enderror"
                            value="{{ old('phone_number', $profile->phone_number) }}">

                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="address">Alamat</label>
                <textarea name="address" id="address" cols="5" rows="5"
                    class="form-control @error('address') is-invalid @enderror">{{ old('address', $profile->address) }}</textarea>

                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="education">Pendidikan</label>
                <textarea name="education" id="education" cols="5" rows="5"
                    class="form-control @error('education') is-invalid @enderror">{{ old('education', $profile->education) }}</textarea>

                @error('education')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="experience">Pengalaman</label>
                <textarea name="experience" id="experience" cols="5" rows="5"
                    class="form-control @error('experience') is-invalid @enderror">{{ old('experience', $profile->experience) }}</textarea>

                @error('experience')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="skills">Keahlian</label>
                <textarea name="skills" id="skills" cols="5" rows="5"
                    class="form-control @error('skills') is-invalid @enderror">{{ old('skills', $profile->skills) }}</textarea>

                @error('skills')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="resume_url">URL CV</label>
                    <input type="url" name="resume_url" id="resume_url"
                        class="form-control @error('resume_url') is-invalid @enderror"
                        value="{{ old('resume_url', $profile->resume_url) }}">

                    @error('resume_url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="float-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
