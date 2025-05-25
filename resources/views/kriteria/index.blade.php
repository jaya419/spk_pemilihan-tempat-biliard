@extends('layouts.app')

@section('title', 'Daftar Kriteria')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-teal text-white d-flex justify-content-between align-items-center py-3 rounded-top-4">
            <h2 class="h5 mb-0"><i class="bi bi-list-check me-2"></i> Daftar Kriteria</h2>
            <a href="{{ route('kriteria.create') }}" class="btn btn-light btn-sm shadow-sm rounded-pill px-3">
                <i class="bi bi-plus-lg me-1"></i> Tambah Kriteria Baru
            </a>
        </div>

        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                    <h5 class="alert-heading mb-2"><i class="bi bi-check-circle-fill me-2"></i> Berhasil!</h5>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                    <h5 class="alert-heading mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i> Terjadi Kesalahan!</h5>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($kriterias->count())
                <div class="rounded-3 shadow-sm table-fade-in">
                    <table class="table table-hover table-striped mb-0 border border-light-subtle">
                        <thead class="bg-gradient-teal text-white">
                            <tr>
                                <th scope="col" class="py-3 ps-4">No</th>
                                <th scope="col" class="py-3">Nama Kriteria</th>
                                <th scope="col" class="py-3">Bobot (%)</th>
                                <th scope="col" class="py-3">Tipe</th>
                                <th scope="col" class="py-3 text-center" style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kriterias as $kriteria)
                            <tr class="align-middle table-row-hover">
                                <td class="fw-semibold ps-4">{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $kriteria->nama }}</td>
                                <td>{{ $kriteria->bobot }}</td>
                                <td class="text-capitalize">{{ $kriteria->tipe }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('kriteria.edit', $kriteria->id) }}" 
                                           class="btn btn-sm btn-outline-teal rounded-circle hover-scale" 
                                           title="Edit" data-bs-toggle="tooltip">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus kriteria ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle hover-scale" title="Hapus" data-bs-toggle="tooltip">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        <tr class="table-success fw-bold border-top border-success-subtle">
                            <td colspan="2" class="ps-4">
                                <i class="bi bi-pie-chart-fill me-1 text-success"></i> Total Bobot
                            </td>
                            <td class="text-success">{{ $kriterias->sum('bobot') }} %</td>
                            <td colspan="2"></td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('penilaian.index') }}" class="btn btn-teal rounded-pill px-4 shadow-sm">
                        <i class="bi bi-calculator-fill me-2"></i> Lanjutkan ke Penilaian
                    </a>
                </div>

            @else
                <div class="alert alert-info d-flex align-items-center rounded-3 p-4 shadow-sm" role="alert">
                    <i class="bi bi-info-circle-fill me-3 fs-3"></i>
                    <div>
                        <h5 class="alert-heading mb-2">Data Tidak Ditemukan</h5>
                        <p class="mb-0">Belum ada data kriteria yang tersedia. Silakan tambahkan kriteria baru untuk memulai.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .bg-teal {
        background-color: #20c997 !important;
    }

    .btn-teal {
        color: #fff;
        background-color: #20c997;
        border-color: #20c997;
    }

    .btn-teal:hover {
        color: #fff;
        background-color: #1abc9c;
        border-color: #1abc9c;
    }

    .btn-outline-teal {
        color: #20c997;
        border-color: #20c997;
    }

    .btn-outline-teal:hover {
        color: #fff;
        background-color: #20c997;
        border-color: #20c997;
    }

    .bg-gradient-teal {
        background: linear-gradient(to right, #20c997, #1abc9c);
    }

    .table-row-hover:hover {
        background-color: rgba(32, 201, 151, 0.1);
        transform: scale(1.005);
        transition: all 0.2s ease-in-out;
    }

    .hover-scale {
        transition: transform 0.2s ease-in-out;
    }

    .hover-scale:hover {
        transform: scale(1.1);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .table-fade-in {
        animation: fadeIn 0.6s ease-out forwards;
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endpush
@endsection
