@extends('layouts.app')

@section('title', 'Daftar Karyawan')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4"> {{-- Added rounded-4 for more rounded corners --}}
        <div class="card-header bg-teal text-white d-flex justify-content-between align-items-center py-3 rounded-top-4"> {{-- Added rounded-top-4 --}}
            <h2 class="h5 mb-0"><i class="bi bi-people-fill me-2"></i> Daftar Karyawan</h2>
            <a href="{{ route('karyawan.create') }}" class="btn btn-light btn-sm shadow-sm rounded-pill px-3"> {{-- Added rounded-pill and px-3 --}}
                <i class="bi bi-plus-lg me-1"></i> Tambah Karyawan Baru
            </a>
        </div>

        <div class="card-body p-4">
            <form method="GET" action="{{ route('karyawan.index') }}" class="mb-4">
                <div class="input-group input-group-md shadow-sm rounded-pill overflow-hidden border border-teal"> {{-- Added border border-teal --}}
                    <input type="search" name="q" class="form-control border-0 ps-4 rounded-pill-start" 
                           placeholder="Cari berdasarkan nama, email, atau telepon..." 
                           value="{{ request('q') }}" aria-label="Search">
                    <button class="btn btn-teal border-0 px-4" type="submit">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>
                    @if(request('q'))
                    <a href="{{ route('karyawan.index') }}" class="btn btn-outline-secondary border-0 px-4">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </a>
                    @endif
                </div>
            </form>

            @if($karyawans->count())
            <div class=" rounded-3 shadow-sm table-fade-in"> {{-- Added table-fade-in --}}
                <table class="table table-hover table-striped mb-0 border border-light-subtle"> {{-- Changed border to border-light-subtle --}}
                    <thead class="bg-gradient-teal text-white"> {{-- Changed bg-light text-dark to bg-gradient-teal text-white --}}
                        <tr>
                            <th scope="col" class="py-3 ps-4">No</th>
                            <th scope="col" class="py-3">Nama</th>
                            <th scope="col" class="py-3">Email</th>
                            <th scope="col" class="py-3">Telepon</th>
                            <th scope="col" class="py-3">Alamat</th>
                            <th scope="col" class="py-3 text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($karyawans as $karyawan)
                        <tr class="align-middle table-row-hover"> {{-- Added table-row-hover --}}
                            <td class="fw-semibold ps-4">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $karyawan->nama }}</td>
                            <td>{{ $karyawan->email }}</td>
                            <td>{{ $karyawan->telepon }}</td>
                            <td class="text-truncate" style="max-width: 250px;" title="{{ $karyawan->alamat }}">
                                {{ $karyawan->alamat }}
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('karyawan.edit', $karyawan->id) }}" 
                                       class="btn btn-sm btn-outline-teal rounded-circle hover-scale" {{-- Added hover-scale --}}
                                       title="Edit" data-bs-toggle="tooltip">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle hover-scale" title="Hapus" data-bs-toggle="tooltip"> {{-- Added hover-scale --}}
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-info d-flex align-items-center rounded-3 p-4 shadow-sm" role="alert">
                <i class="bi bi-info-circle-fill me-3 fs-3"></i>
                <div>
                    <h5 class="alert-heading mb-2">Data Tidak Ditemukan</h5>
                    <p class="mb-0">Tidak ada data karyawan yang tersedia. Silakan tambahkan data baru untuk mulai.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Custom Teal Color */
    .bg-teal {
        background-color: #20c997 !important; /* A vibrant teal */
    }

    .btn-teal {
        color: #fff;
        background-color: #20c997;
        border-color: #20c997;
    }

    .btn-teal:hover {
        color: #fff;
        background-color: #1abc9c; /* Slightly darker teal on hover */
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

    /* Gradient for table header */
    .bg-gradient-teal {
        background: linear-gradient(to right, #20c997, #1abc9c); /* Teal gradient */
    }

    /* Table Row Hover Effect */
    .table-row-hover:hover {
        background-color: rgba(32, 201, 151, 0.1); /* Light teal tint on hover */
        transform: scale(1.005); /* Slightly scale up */
        transition: all 0.2s ease-in-out;
    }

    /* Button Hover Scale Effect */
    .hover-scale {
        transition: transform 0.2s ease-in-out;
    }

    .hover-scale:hover {
        transform: scale(1.1);
    }

    /* Table Fade In Animation */
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