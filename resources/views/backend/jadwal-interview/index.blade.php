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
            <li class="breadcrumb-item active" aria-current="page">Kelola Interview</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">List Jadwal Interview</h1>
            <p class="mb-0">Kelola Jadwal Interview Pelamar</p>
        </div>
        <div>
            <a href="{{ route('panel.jadwal-interview.create') }}"
                class="btn btn-primary d-inline-flex align-items-center">
                <i class="fas fa-plus me-2"></i> Buat Jadwal Baru
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

{{-- Table --}}
<div class="card border-0 shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-hover rounded">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelamar</th>
                        <th>Posisi</th>
                        <th>Tanggal Interview</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($interviews as $interview)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $interview->application->applicant->profile->full_name }}</td>
                        <td>{{ $interview->application->jobdesc->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($interview->interview_date)->translatedFormat('d F Y H:i') }}
                        </td>
                        <td>
                            <span class="badge bg-{{ $interview->interview_method == 'online' ? 'black' : 'gray-500' }}">
                                {{ ucfirst($interview->interview_method) }}
                            </span>
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
                            <div class="btn-group">
                                <a href="{{ route('panel.jadwal-interview.show', $interview->uuid) }}"
                                    class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('panel.jadwal-interview.edit', $interview->uuid) }}"
                                    class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-danger" onclick="deleteInterview(this)"
                                    data-uuid="{{ $interview->uuid }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada jadwal interview</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $interviews->links() }}
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const deleteInterview = (e) => {
        let uuid = e.getAttribute('data-uuid')

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "DELETE",
                    url: `/panel/kelola-interview/${uuid}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        Swal.fire({
                            title: "Deleted!",
                            text: data.message,
                            icon: "success",
                            timer: 1000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function (data) {
                        Swal.fire({
                            title: "Failed!",
                            text: "Your file has not been deleted.",
                            icon: "error"
                        });

                        console.log(data);
                    }
                });
            }
        });
    }

</script>
@endpush
