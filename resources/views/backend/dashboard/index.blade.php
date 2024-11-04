@extends('backend.template.main')

@section('title', 'Dashboard')

@section('content')
{{-- content --}}
@if (Auth::user()->role == 'admin')
<div class="row">
    <div class="col-12 mt-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h2 class="fs-4 fw-bold pt-2 mt-2">Selamat Datang <button
                        class="btn btn-warning fs-6 text-capitalize text-black rounded-pill">{{ Auth::user()->username }}!</button>
                </h2>
                <p>Terimakasih atas kerja keras-nya, semoga Anda dalam keadaan baik 😇</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4 mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Lamaran</h5>
                <h2 class="card-text">{{ $totalApplications }}</h2>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Lamaran Pending</h5>
                <h2 class="card-text text-warning">{{ $pendingApplications }}</h2>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Lamaran Direview</h5>
                <h2 class="card-text text-info">{{ $reviewedApplications }}</h2>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Lamaran Diterima</h5>
                <h2 class="card-text text-success">{{ $acceptedApplications }}</h2>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Lamaran Ditolak</h5>
                <h2 class="card-text text-danger">{{ $rejectedApplications }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-xl-8">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card bg-yellow-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Grafik Lamaran 7 Hari Terakhir</h5>
                        <canvas id="applicationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="col-12 px-0 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Distribusi Status Lamaran</h5>
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4 mt-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">5 Lamaran Terbaru</h5>
                <div class="table-responsive">
                    <table class="table table-centered table-hover table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pelamar</th>
                                <th>Posisi</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestApplications as $application)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $application->applicant->profile->full_name }}</td>
                                <td>{{ $application->jobdesc->title }}</td>
                                @if ($application->status == 'pending')
                                    <td><span class="badge bg-warning text-black">Pending</span></td>
                                @elseif($application->status == 'reviewed')
                                    <td><span class="badge bg-info">Direview</span></td>
                                @elseif($application->status == 'accepted')
                                    <td><span class="badge bg-success">Diterima</span></td>
                                @elseif ($application->status == 'rejected')
                                    <td><span class="badge bg-danger">Ditolak</span></td>
                                @endif
                                <td>{{ $application->date }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>

<script>
    // Line Chart
    var ctx = document.getElementById('applicationChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($applicationsPerDay->pluck('date')) !!},
            datasets: [{
                label: 'Jumlah Lamaran',
                data: {!! json_encode($applicationsPerDay->pluck('count')) !!},
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderWidth: 2,
                tension: 0.1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1 // Menentukan langkah untuk sumbu Y agar hanya menampilkan bilangan bulat
                    }
                }
            }
        }
    });

    // Doughnut Chart
    var statusCtx = document.getElementById('statusChart').getContext('2d');
    var statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Reviewed', 'Accepted', 'Rejected'],
            datasets: [{
                data: [
                    {{ $pendingApplications }},
                    {{ $reviewedApplications }},
                    {{ $acceptedApplications }},
                    {{ $rejectedApplications }}
                ],
                backgroundColor: [
                    'rgb(255, 205, 86)',
                    'rgb(54, 162, 235)',
                    'rgb(75, 192, 192)',
                    'rgb(255, 99, 132)'
                ],
                borderColor: [
                    'rgb(255, 205, 86)',
                    'rgb(54, 162, 235)',
                    'rgb(75, 192, 192)',
                    'rgb(255, 99, 132)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
@endpush

@else
<div class="row">
    <div class="col-12 mt-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h2 class="fs-4 fw-bold pt-2 mt-2">Selamat Datang <button
                        class="btn btn-warning fs-6 text-capitalize text-black rounded-pill">{{ Auth::user()->username }}!</button>
                </h2>
                <p>Apakah harimumu menyenangkan? 😊</p>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 mt-3">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h2 class="fs-5 fw-bold pt-2 mt-2">Track Status Lamaran</h2>

            <div class="dropdown-divider mt-4 pb-3"></div>

            @if($lamaran->isEmpty())
                <div class="position-relative m-4">
                    <div class="progress" role="progressbar" aria-label="Progress" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100" style="height: 1px;">
                        <div class="progress-bar" style="width: 0%"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span
                            class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-secondary text-black">...</span>
                        <span
                            class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-secondary text-black">...</span>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary text-black">...</span>
                    </div>
                    <div class="text-center mt-4">
                        <p class="text-muted">Anda belum mengajukan lamaran apapun</p>
                    </div>
                </div>
            @else
            @foreach($lamaran as $item)
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="fs-6 fw-bold mb-2 mt-2">{{ $item->jobdesc->title }}</h6>
                <small class="text-muted">{{ $item->created_at->format('d M Y') }}</small>
            </div>
            <div class="position-relative m-4 mb-5">
                <div class="progress" role="progressbar" aria-label="Progress" aria-valuenow="50" aria-valuemin="0"
                    aria-valuemax="100" style="height: 1px;">
                    <div class="progress-bar"
                        style="width: {{ $item->status == 'accepted' || $item->status == 'rejected' ? '100%' : ($item->status == 'reviewed' ? '50%' : '25%') }}">
                    </div>
                </div>

                {{-- Pending Status --}}
                <button type="button"
                    class="position-absolute top-0 start-0 ms-4 translate-middle btn btn-sm {{ $item->status == 'pending' ? 'btn-secondary' : 'btn-primary' }} rounded-pill"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Lamaran Anda sedang dalam antrian">
                    Pending
                </button>

                {{-- Reviewed Status --}}
                @if (in_array($item->status, ['reviewed', 'accepted', 'rejected']))
                <button type="button"
                    class="position-absolute top-0 start-50 translate-middle btn btn-sm {{ $item->status == 'reviewed' ? 'btn-secondary' : 'btn-primary' }} rounded-pill"
                    data-bs-toggle="tooltip" data-bs-placement="top" style="margin-left: -5px;"
                    title="Lamaran Anda sedang ditinjau">
                    Reviewed
                </button>
                @endif

                {{-- Final Status (Accepted/Rejected) --}}
                @if (in_array($item->status, ['accepted', 'rejected']))
                <button type="button"
                    class="position-absolute top-0 start-100 translate-middle btn btn-sm {{ $item->status == 'accepted' ? 'btn-success' : 'btn-danger' }} rounded-pill text-white"
                    data-bs-toggle="tooltip" data-bs-placement="top" style="margin-left: -27px;"
                    title="{{ $item->status == 'accepted' ? 'Selamat! Anda lolos dalam lamaran ini.' : 'Maaf, Anda tidak lolos dalam lamaran ini. Silahkan coba lagi di lain waktu' }}">
                    {{ $item->status == 'accepted' ? 'Accepted' : 'Rejected' }}
                </button>
                @endif
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>

<div class="col-12 mt-3">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h2 class="fs-5 fw-bold pt-2 mt-2">Informasi Pengguna</h2>

            <div class="dropdown-divider mt-4"></div>

            <div class="row">
                <div class="col-md-6">
                    <h3 class="fs-5 fw-bold pt-2 mt-2">IP Anda</h3>
                    <p>{{ $userInfo['ip_address'] }}</p>

                    <h3 class="fs-5 fw-bold pt-2 mt-2">Lokasi</h3>
                    <p>{{ $userInfo['country'] }}, {{ $userInfo['city'] }}</p>

                    <h3 class="fs-5 fw-bold pt-2 mt-2">Tipe Browser</h3>
                    <p>{{ $userInfo['browser'] }}</p>

                    <h3 class="fs-5 fw-bold pt-2 mt-2">User Agent</h3>
                    <p style="word-wrap: break-word;">{{ $userInfo['user_agent'] }}</p>
                </div>

                <div class="col-md-6">
                    <h3 class="fs-5 fw-bold pt-2 mt-2">Platform</h3>
                    <p>{{ $userInfo['platform'] }} ({{ $userInfo['device_type'] }})</p>

                    <h3 class="fs-5 fw-bold pt-2 mt-2">Waktu Akses</h3>
                    <p>{{ $userInfo['last_activity']->isoFormat('D MMMM YYYY, HH:mm:ss') }}</p>

                    <h3 class="fs-5 fw-bold pt-2 mt-2">Halaman Terakhir</h3>
                    <p>{{ $userInfo['last_page'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endif
@endsection
