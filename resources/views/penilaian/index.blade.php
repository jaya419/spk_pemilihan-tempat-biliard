@extends('layouts.app')

@section('title', 'Penilaian Karyawan')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-teal text-white d-flex justify-content-between align-items-center py-3 rounded-top-4">
            <h2 class="h5 mb-0"><i class="bi bi-person-lines-fill me-2"></i> Form Penilaian Karyawan</h2>
        </div>

        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                    <h5 class="alert-heading mb-2"><i class="bi bi-check-circle-fill me-2"></i> Penilaian Berhasil Disimpan!</h5>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                    <h5 class="alert-heading mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i> Ada Kesalahan Input!</h5>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('penilaian.store') }}" method="POST">
                @csrf

                @if($karyawans->count() > 0 && $kriterias->count() > 0)
                    <div class="rounded-3 shadow-sm table-fade-in mb-4">
                        <table class="table table-hover table-striped mb-0 border border-light-subtle">
                            <thead class="bg-gradient-teal text-white text-center">
                                <tr>
                                    <th scope="col" class="py-3 ps-4">No</th>
                                    <th scope="col" class="py-3">Karyawan</th>
                                    @foreach($kriterias as $kriteria)
                                        <th scope="col" class="py-3 text-capitalize">
                                            {{ $kriteria->nama }}<br>
                                            <small class="fw-normal">({{ $kriteria->bobot }}% - {{ $kriteria->tipe }})</small>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($karyawans as $karyawan)
                                <tr class="align-middle table-row-hover">
                                    <td class="fw-semibold ps-4">{{ $loop->iteration }}</td>
                                    <td class="fw-semibold text-nowrap">{{ $karyawan->nama }}</td>
                                    <input type="hidden" name="karyawan_ids[]" value="{{ $karyawan->id }}">

                                    @foreach($kriterias as $kriteria)
                                    <td class="text-center">
                                        @php
                                            $nilaiSebelumnya = $penilaians[$karyawan->id . '-' . $kriteria->id]->nilai ?? null;
                                            $defaultValue = old('nilai.' . $karyawan->id . '.' . $kriteria->id) ?? $nilaiSebelumnya;
                                            $alreadyRated = $nilaiSebelumnya !== null;
                                        @endphp
                                        <input 
                                            type="number" 
                                            name="nilai[{{ $karyawan->id }}][{{ $kriteria->id }}]" 
                                            min="0" max="100" step="1" 
                                            value="{{ $defaultValue }}" 
                                            required
                                            placeholder="0-100"
                                            class="form-control form-control-sm text-center score-input @error('nilai.' . $karyawan->id . '.' . $kriteria->id) is-invalid @enderror {{ $alreadyRated ? 'border-success bg-light' : '' }}"
                                        >
                                        @error('nilai.' . $karyawan->id . '.' . $kriteria->id)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-teal shadow-sm rounded-pill px-4">
                            <i class="bi bi-save-fill me-2"></i> Simpan Penilaian
                        </button>
                        <a href="{{ route('kriteria.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-arrow-left-circle-fill me-2"></i> Kembali
                        </a>
                    </div>
                @else
                    <div class="alert alert-warning d-flex align-items-center rounded-3 p-4 shadow-sm" role="alert">
                        <i class="bi bi-exclamation-circle-fill me-3 fs-3"></i>
                        <div>
                            <h5 class="alert-heading mb-2">Belum Ada Data yang Cukup</h5>
                            <p class="mb-0">Pastikan Anda telah menambahkan <strong>Karyawan</strong> dan <strong>Kriteria</strong> terlebih dahulu sebelum melakukan penilaian.</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('karyawan.index') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-people-fill me-2"></i> Tambah Karyawan
                        </a>
                        <a href="{{ route('kriteria.index') }}" class="btn btn-teal rounded-pill px-4">
                            <i class="bi bi-list-check me-2"></i> Tambah Kriteria
                        </a>
                    </div>
                @endif
            </form>
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

    .bg-gradient-teal {
        background: linear-gradient(to right, #20c997, #1abc9c);
    }

    .table-row-hover:hover {
        background-color: rgba(32, 201, 151, 0.1);
        transform: scale(1.005);
        transition: all 0.2s ease-in-out;
    }

    .table-fade-in {
        animation: fadeIn 0.6s ease-out forwards;
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

    .score-input {
        max-width: 80px;
        margin: 0 auto;
    }
</style>
@endsection
