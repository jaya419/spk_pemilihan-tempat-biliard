@extends('layouts.app') {{-- Assuming you have a layout file --}}

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-lg animate__animated animate__fadeIn">
        <div class="card-header bg-primary text-white text-center py-4">
            <h1 class="mb-0 display-4 fw-bold" style="font-family: 'Montserrat', sans-serif;">
                <i class="fas fa-map-marker-alt me-3"></i> Daftar Tempat Billiard
            </h1>
            <p class="lead mb-0">Kelola informasi lengkap tentang lokasi-lokasi billiard favorit Anda.</p>
        </div>
        <div class="card-body p-4 p-md-5">

            {{-- Action Button --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 mb-0 text-dark fw-bold">Tempat Billiard Tersedia</h2>
                <a href="{{ route('alternative.create') }}" class="btn btn-success custom-btn animate__animated animate__pulse animate__infinite">
                    <i class="fas fa-plus-circle me-2"></i> Tambah Tempat Baru
                </a>
            </div>

            {{-- Session Messages --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
                    <i class="fas fa-times-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Search Form --}}
            <form action="{{ route('alternative.index') }}" method="GET" class="mb-5 animate__animated animate__fadeIn">
                <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden border">
                    <span class="input-group-text bg-white border-0 ps-3 pe-0 rounded-start-pill">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" name="q" class="form-control border-0" placeholder="Cari tempat billiard berdasarkan nama atau alamat..." value="{{ request('q') }}">
                    <button class="btn btn-primary-gradient px-4 py-2" type="submit" data-bs-toggle="tooltip" title="Cari Tempat">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                    @if (request('q'))
                        <a href="{{ route('alternative.index') }}" class="btn btn-outline-danger px-3 py-2" data-bs-toggle="tooltip" title="Reset Pencarian">
                            <i class="fas fa-times me-1"></i> Reset
                        </a>
                    @endif
                </div>
            </form>

            {{-- Alternatives List --}}
            @if ($alternatives->isEmpty())
                <div class="alert alert-info text-center py-4 animate__animated animate__fadeInUp">
                    <h4 class="alert-heading"><i class="fas fa-info-circle me-2"></i> Belum ada tempat billiard yang ditambahkan!</h4>
                    <p class="mb-0">Yuk, mulai tambahkan data tempat billiard untuk dikelola.</p>
                </div>
            @else
                <div class="table-responsive shadow-sm rounded-lg">
                    <table class="table table-hover table-striped mb-0 custom-table">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="text-primary">No</th>
                                <th scope="col" class="text-primary">Nama</th>
                                <th scope="col" class="text-primary">Alamat</th>
                                <th scope="col" class="text-primary text-center">Kontak</th>
                                <th scope="col" class="text-primary">Deskripsi</th>
                                <th scope="col" class="text-primary text-center">Jam Operasional</th>
                                <th scope="col" class="text-primary text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatives as $alternative)
                                <tr class="animate__animated animate__fadeInUp animate__faster table-row-hover">
                                    <td class="align-middle fw-bold">{{ $loop->iteration }}</td>
                                    <td class="align-middle fw-bold">{{ $alternative->name }}</td>
                                    <td class="align-middle text-muted small">{{ $alternative->address ?? '-' }}</td>
                                    <td class="align-middle text-center">{{ $alternative->contact ?? '-' }}</td>
                                    <td class="align-middle text-muted small">{{ Str::limit($alternative->description, 50) ?? '-' }}</td>
                                    <td class="align-middle text-center text-nowrap">
                                        @if ($alternative->open_hour && $alternative->close_hour)
                                            <span class="badge bg-secondary text-white">
                                                {{ \Carbon\Carbon::parse($alternative->open_hour)->format('H:i') }} - {{ \Carbon\Carbon::parse($alternative->close_hour)->format('H:i') }}
                                            </span>
                                        @else
                                            <span class="badge bg-light text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center text-nowrap">
                                        <a href="{{ route('alternative.edit', $alternative->id) }}" class="btn btn-sm btn-warning me-2" data-bs-toggle="tooltip" title="Edit Tempat">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('alternative.destroy', $alternative->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tempat billiard ini? Tindakan ini tidak dapat dibatalkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Hapus Tempat">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- Pagination (if applicable) --}}
            @if ($alternatives instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="mt-4 d-flex justify-content-center">
                    {{ $alternatives->links('pagination::bootstrap-5') }} {{-- Use Bootstrap 5 pagination style --}}
                </div>
            @endif

            {{-- Back to Dashboard navigation --}}
            <div class="text-center mt-5">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary custom-btn">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
                </a>
            </div>

        </div>
    </div>
</div>

<style>
    /* Google Fonts Import */
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap');

    body {
        background-color: #f0f2f5; /* Light grey background */
        font-family: 'Open Sans', sans-serif;
        color: #343a40;
    }

    .container {
        max-width: 1200px; /* Wider container for more table columns */
    }

    .card {
        border-radius: 0.75rem; /* Slightly rounded corners */
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08); /* Soft shadow */
    }

    .card-header {
        background: linear-gradient(135deg, #007bff, #0056b3); /* Primary blue gradient */
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
    }

    h1, h2 {
        font-family: 'Montserrat', sans-serif;
    }

    .display-4 {
        font-size: 2.5rem; /* Adjusted for better fit in header */
        font-weight: 700;
    }

    .lead {
        color: rgba(255, 255, 255, 0.85);
    }

    .table {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 0.5rem; /* Apply border-radius to the table itself */
        overflow: hidden; /* Ensures content respects border-radius */
    }

    .table thead th {
        border-bottom: 2px solid #dee2e6;
        vertical-align: middle;
        padding: 1rem;
        font-weight: 600;
        background-color: #e9ecef; /* Light background for table header */
        text-align: left; /* Default to left-align for better readability of text */
    }

    /* Adjust specific header alignments if needed, overriding generic left-align */
    .table thead th.text-center {
        text-align: center;
    }

    .table tbody tr {
        transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .table tbody tr.table-row-hover:hover {
        background-color: #f8f9fa; /* Lighter hover effect */
        transform: scale(1.005); /* Slight scale on hover */
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05); /* Subtle shadow on hover */
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-top: 1px solid #e9ecef;
    }

    .btn {
        font-weight: 600;
        border-radius: 0.35rem; /* Slightly rounded buttons */
        transition: all 0.2s ease-in-out;
    }

    .custom-btn {
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
        transform: translateY(-2px);
        box-shadow: 0 0.25rem 0.5rem rgba(40, 167, 69, 0.2);
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #343a40; /* Dark text for warning button */
    }
    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #cc9500;
        transform: translateY(-1px);
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
        transform: translateY(-1px);
    }

    .btn-outline-primary {
        color: #007bff;
        border-color: #007bff;
    }
    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
    }
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: #fff;
    }

    .alert {
        border-radius: 0.5rem;
        font-size: 1.05rem;
    }

    .alert-info {
        background-color: #e0f7fa;
        color: #007bff;
        border-color: #b3e5fc;
    }

    /* Input group styling for search bar */
    .input-group-lg > .form-control,
    .input-group-lg > .btn {
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        height: auto; /* Allow height to adjust */
    }
    .rounded-start-pill {
        border-top-left-radius: 2rem !important;
        border-bottom-left-radius: 2rem !important;
    }
    /* Specific styling for the search button within the input group */
    .input-group-lg .btn-primary-gradient {
        border-top-right-radius: 2rem !important;
        border-bottom-right-radius: 2rem !important;
        margin-left: -1px; /* Remove gap between input and button */
        background: linear-gradient(45deg, #007bff, #0056b3); /* Gradient for search button */
        color: white;
        border: none; /* Remove border as gradient handles it */
    }
    .input-group-lg .btn-primary-gradient:hover {
        background: linear-gradient(45deg, #0056b3, #007bff); /* Reverse gradient on hover */
        transform: translateY(0); /* No transform for this button */
        box-shadow: none; /* No shadow for this button */
    }

    /* Adjusting radius for the reset button when it's present */
    .input-group-lg .btn-outline-danger {
        border-top-right-radius: 2rem !important;
        border-bottom-right-radius: 2rem !important;
        border-top-left-radius: 0 !important; /* Ensure it's not rounded on the left */
        border-bottom-left-radius: 0 !important; /* Ensure it's not rounded on the left */
        margin-left: -1px; /* Remove gap between search button and reset button */
    }

    /* Badge for operational hours */
    .badge {
        font-size: 0.85em;
        padding: 0.5em 0.75em;
        border-radius: 0.35rem;
        font-weight: 600;
    }

    /* Animate.css integration (ensure you have animate.css linked in your main layout) */
    /* Example: <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> */
    .animate__animated.animate__fadeIn {
        animation-duration: 0.8s;
    }
    .animate__animated.animate__fadeInDown {
        animation-duration: 0.6s;
    }
    .animate__animated.animate__fadeInUp {
        animation-duration: 0.5s;
    }
    .animate__animated.animate__pulse {
        animation-duration: 1.5s;
    }
    .animate__animated.animate__faster {
        animation-duration: 0.3s; /* Quicker animation for table rows */
    }
</style>
@endsection
