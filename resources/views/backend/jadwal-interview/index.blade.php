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
            <button type="button" data-bs-toggle="modal" data-bs-target="#downloadModal"
                class="btn btn-success d-inline-flex align-items-center text-white me-2">
                <i class="fas fa-file-arrow-down me-1"></i> Download
            </button>
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

<!-- Modal Download -->
<div class="modal fade" id="downloadModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    <i class="fas fa-file-arrow-down"></i> Download Laporan Interview
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('panel.jadwal-interview.download') }}" method="post" id="downloadForm">
                    @csrf

                    <!-- Pilihan Format -->
                    <div class="mb-3">
                        <label for="format" class="form-label">Format Laporan</label>
                        <select name="format" id="format" class="form-select @error('format') is-invalid @enderror">
                            <option value="" hidden>-- Pilih Format --</option>
                            <option value="pdf" {{ old('format') == 'pdf' ? 'selected' : '' }}>PDF</option>
                            <option value="excel" {{ old('format') == 'excel' ? 'selected' : '' }}>Excel</option>
                        </select>
                        @error('format')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tanggal Mulai -->
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date"
                            class="form-control @error('start_date') is-invalid @enderror"
                            value="{{ old('start_date') }}">
                        @error('start_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tanggal Akhir -->
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="end_date" id="end_date"
                            class="form-control @error('end_date') is-invalid @enderror"
                            value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Preview Format -->
                    <div class="mt-3">
                        <div id="pdfPreview" class="d-none">
                            <div class="alert alert-info">
                                <h6 class="alert-heading">
                                    <i class="fas fa-file-pdf"></i> Format PDF
                                </h6>
                                <p class="mb-0">Laporan akan diunduh dalam format PDF dengan tampilan yang terstruktur, termasuk:</p>
                                <ul class="mb-0">
                                    <li>Header laporan dengan periode</li>
                                    <li>Ringkasan jumlah interview (Total, Scheduled, Completed, Cancelled)</li>
                                    <li>Tabel jadwal interview lengkap</li>
                                    <li>Footer dengan informasi cetak</li>
                                </ul>
                            </div>
                        </div>
                        <div id="excelPreview" class="d-none">
                            <div class="alert alert-success">
                                <h6 class="alert-heading">
                                    <i class="fas fa-file-excel"></i> Format Excel
                                </h6>
                                <p class="mb-0">Laporan akan diunduh dalam format Excel (.xlsx) yang dapat diedit, dengan:</p>
                                <ul class="mb-0">
                                    <li>Data yang dapat difilter dan diurutkan</li>
                                    <li>Format yang mudah diolah</li>
                                    <li>Informasi jadwal interview lengkap</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="submit" form="downloadForm" class="btn btn-secondary">
                    <i class="fas fa-download"></i> Download
                </button>
            </div>
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

    // Preview format yang dipilih
    document.getElementById('format').addEventListener('change', function() {
        // Sembunyikan semua preview
        document.getElementById('pdfPreview').classList.add('d-none');
        document.getElementById('excelPreview').classList.add('d-none');

        // Tampilkan preview yang dipilih
        if (this.value === 'pdf') {
            document.getElementById('pdfPreview').classList.remove('d-none');
        } else if (this.value === 'excel') {
            document.getElementById('excelPreview').classList.remove('d-none');
        }
    });

    // Validasi form download
    document.getElementById('downloadForm').addEventListener('submit', function(e) {
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        const format = document.getElementById('format').value;

        if (!format) {
            e.preventDefault();
            alert('Silakan pilih format laporan');
            return;
        }

        if (!startDate || !endDate) {
            e.preventDefault();
            alert('Silakan isi kedua tanggal');
            return;
        }

        if (new Date(startDate) > new Date(endDate)) {
            e.preventDefault();
            alert('Tanggal mulai tidak boleh lebih besar dari tanggal akhir');
            return;
        }
    });

    // Set default dates untuk range 30 hari terakhir
    window.addEventListener('load', function() {
        const today = new Date();
        const thirtyDaysAgo = new Date(today);
        thirtyDaysAgo.setDate(today.getDate() - 30);

        document.getElementById('end_date').value = today.toISOString().split('T')[0];
        document.getElementById('start_date').value = thirtyDaysAgo.toISOString().split('T')[0];
    });

</script>
@endpush
