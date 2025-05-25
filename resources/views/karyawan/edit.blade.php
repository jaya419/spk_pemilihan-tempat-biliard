@extends('layouts.app')

@section('title', 'Edit Karyawan')

@section('content')
<div class="container-fluid py-3"> {{-- Reduced vertical padding from py-4 to py-3 --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-teal text-white d-flex justify-content-between align-items-center py-3 rounded-top-4">
            <h2 class="h5 mb-0"><i class="bi bi-person-fill-gear me-2"></i> Edit Data Karyawan</h2> {{-- Changed title and added icon --}}
        </div>

        <div class="card-body p-3"> {{-- Reduced padding from p-4 to p-3 --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                    <h5 class="alert-heading mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i> Terjadi Kesalahan!</h5>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Essential for update operations in Laravel --}}

                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" 
                           class="form-control rounded-3 @error('nama') is-invalid @enderror" 
                           value="{{ old('nama', $karyawan->nama) }}" placeholder="Masukkan nama lengkap" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" id="email" 
                           class="form-control rounded-3 @error('email') is-invalid @enderror"
                           value="{{ old('email', $karyawan->email) }}" placeholder="contoh@domain.com" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="telepon" class="form-label fw-semibold">Nomor Telepon</label>
                    <input type="text" name="telepon" id="telepon" 
                           class="form-control rounded-3 @error('telepon') is-invalid @enderror"
                           value="{{ old('telepon', $karyawan->telepon) }}" placeholder="Contoh: 081234567890" required>
                    @error('telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="alamat" class="form-label fw-semibold">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" 
                              class="form-control rounded-3 @error('alamat') is-invalid @enderror"
                              rows="3" placeholder="Masukkan alamat lengkap karyawan" required>{{ old('alamat', $karyawan->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-teal shadow-sm rounded-pill px-4">
                        <i class="bi bi-arrow-clockwise me-2"></i> Update Data
                    </button>
                    <a href="{{ route('karyawan.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-x-circle-fill me-2"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Custom Teal Color (from previous example) */
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
</style>
@endsection