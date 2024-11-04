@extends('backend.template.main')

@section('title', 'List Lowongan Pekerjaan')

@push('css')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    /* Glassmorphism Style */
    .glass-card {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.75);
        -webkit-box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.75);
        transition: transform 0.3s ease-in-out;
    }

    .glass-card:hover {
        transform: translateY(-10px);
    }

    .glass-card h1,
    .glass-card p {
        font-family: 'Poppins', sans-serif;
    }

    .glass-card a.btn {
        background: linear-gradient(135deg, #6a82fb 0%, #fc5c7d 100%);
        border: none;
        color: #ffffff;
        transition: background-color 0.3s ease;
    }

    .glass-card a.btn:hover {
        background: linear-gradient(135deg, #fc5c7d 0%, #6a82fb 100%);
    }

    .glass-container {
        padding: 50px 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    /* Breadcrumb */
    .breadcrumb {
        background-color: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(5px);
        border-radius: 8px;
    }

    .breadcrumb-item a {
        font-family: 'Poppins', sans-serif;
    }

    h1.h4 {
        font-family: 'Poppins', sans-serif;
    }

    p {
        font-family: 'Poppins', sans-serif;
    }

    /* Additional Styling */
    body {
        background: #F2F4F6;
        font-family: 'Poppins', sans-serif;
    }

    .alert {
        font-family: 'Poppins', sans-serif;
    }

</style>
@endpush


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
            <li class="breadcrumb-item active" aria-current="page">List Loker</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">List Lowongan Kerja</h1>
            <p class="mb-0">Temukan Lowongan Kerja yang Sesuai</p>
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

<div class="row glass-container">
    @forelse ($lokers as $loker)
    <div class="col-md-5 mb-4">
        <div class="card border-0 glass-card">
            <div class="card-body">
                <h1 class="card-title display-4">{{ $loker->title }}</h1>
                <h6 class="card-subtitle mb-2">{{ $loker->company_name }} <i class="far fa-circle-check"></i></h6>
                <div class="card border-0 glass-card shadow">
                    <div class="card-body">
                        <p class="card-text"><i class="fas fa-location-dot"></i> {{ $loker->location }}</p>
                        <p class="card-text"><i class="fas fa-building"></i> {{ $loker->position }}</p>
                        <p class="card-text"><i class="fas fa-money-bill"></i> Rp{{ number_format($loker->salary_range_min, 0, ',', '.') }}
                            - Rp{{ number_format($loker->salary_range_max, 0, ',', '.') }}</p>
                    </div>
                </div>
                <a href="{{ route('panel.list.show', $loker->uuid) }}" class="btn btn-primary mt-3">View Details</a>
                <p class="card-text mt-3">{{ $loker->created_at->locale('id')->diffForHumans() }}</p>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center">
        <p>No job openings available at the moment.</p>
    </div>
    @endforelse
</div>

<div class="mt-3">
    {{ $lokers->links() }}
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js">
    < /scrip> <
    script src = "https://cdn.jsdelivr.net/npm/sweetalert2@11" >

</script>

<script>
    const deleteReview = (e) => {
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
                    url: `/panel/review/${uuid}`,
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
                            text: "Your data has not been deleted.",
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
