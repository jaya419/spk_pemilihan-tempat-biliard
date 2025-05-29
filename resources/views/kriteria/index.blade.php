@extends('layouts.app') {{-- Assuming you have a layout file --}}

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-lg animate__animated animate__fadeIn">
        <div class="card-header bg-primary text-white text-center py-4">
            <h1 class="mb-0 display-4 fw-bold" style="font-family: 'Montserrat', sans-serif;">
                <i class="fas fa-clipboard-list me-3"></i> Daftar Kriteria
            </h1>
            <p class="lead mb-0">Kelola kriteria yang digunakan untuk penilaian tempat billiard.</p>
        </div>
        <div class="card-body p-4 p-md-5">

            {{-- Action Buttons --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 mb-0 text-dark fw-bold">Kriteria Tersedia</h2>
                <div class="d-flex gap-2">
                    <a href="{{ route('kriteria.create') }}" class="btn btn-success custom-btn animate__animated animate__pulse animate__infinite">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Kriteria
                    </a>
                    {{-- Penilaian Button --}}
                    <a href="{{ route('score.index') }}" class="btn btn-info custom-btn animate__animated animate__pulse animate__infinite">
                        <i class="fas fa-calculator me-2"></i> Lakukan Penilaian
                    </a>
                </div>
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

            @if ($kriterias->isEmpty())
                <div class="alert alert-info text-center py-4 animate__animated animate__fadeInUp">
                    <h4 class="alert-heading"><i class="fas fa-info-circle me-2"></i> Belum ada kriteria yang ditambahkan!</h4>
                    <p class="mb-0">Silakan tambahkan kriteria baru untuk memulai penilaian.</p>
                </div>
            @else
                <div class="table-responsive shadow-sm rounded-lg">
                    <table class="table table-hover table-striped mb-0 custom-table">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="text-primary">No</th>
                                <th scope="col" class="text-primary">Nama Kriteria</th>
                                <th scope="col" class="text-primary text-center">Bobot (%)</th>
                                <th scope="col" class="text-primary text-center">Tipe</th>
                                <th scope="col" class="text-primary text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kriterias as $kriteria)
                                <tr class="animate__animated animate__fadeInUp animate__faster table-row-hover">
                                    <td class="align-middle fw-bold">{{ $loop->iteration }}</td>
                                    <td class="align-middle fw-bold">{{ $kriteria->name }}</td>
                                    <td class="align-middle text-center">{{ $kriteria->weight }}</td>
                                    <td class="align-middle text-center">
                                        <span class="badge {{ $kriteria->type == 'benefit' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($kriteria->type) }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-center text-nowrap">
                                        <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="btn btn-sm btn-warning me-2" data-bs-toggle="tooltip" title="Edit Kriteria">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kriteria ini? Tindakan ini tidak dapat dibatalkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Hapus Kriteria">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-end text-primary">Total Bobot:</th>
                                <th class="text-center text-success fw-bold">{{ $kriterias->sum('weight') }}%</th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
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
        max-width: 1000px; /* Adjusted container width for criteria list */
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

    .table tfoot th {
        padding: 1rem;
        border-top: 2px solid #dee2e6;
        background-color: #e9ecef;
        font-weight: 700;
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

    .btn-info { /* Styling for the new 'Lakukan Penilaian' button */
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: #fff;
    }
    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
        transform: translateY(-2px);
        box-shadow: 0 0.25rem 0.5rem rgba(23, 162, 184, 0.2);
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

    /* Badge for criteria type */
    .badge {
        font-size: 0.9em;
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
