@extends('layouts.app')

@section('title', 'Tambah Karyawan')

@section('content')
<div class="container-fluid py-3"> {{-- Reduced vertical padding from py-4 to py-3 --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-teal text-white d-flex justify-content-between align-items-center py-3 rounded-top-4">
            <h2 class="h5 mb-0"><i class="bi bi-person-plus-fill me-2"></i> Tambah Karyawan Baru</h2>
        </div>
        <div class="card-body p-3">
            @if ($errors->has('duplicate'))
                <div class="alert alert-danger">
                    {{ $errors->first('duplicate') }}
                </div>
            @endif
            <form action="{{ route('karyawan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" 
                           class="form-control rounded-3 @error('nama') is-invalid @enderror" {{-- Changed form-control-lg to default form-control --}}
                           value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" id="email" 
                           class="form-control rounded-3 @error('email') is-invalid @enderror" {{-- Changed form-control-lg to default form-control --}}
                           value="{{ old('email') }}" placeholder="contoh@domain.com" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="telepon" class="form-label fw-semibold">Nomor Telepon</label>
                    <input type="text" name="telepon" id="telepon" 
                           class="form-control rounded-3 @error('telepon') is-invalid @enderror" {{-- Changed form-control-lg to default form-control --}}
                           value="{{ old('telepon') }}" placeholder="Contoh: 081234567890" required>
                    @error('telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="alamat" class="form-label fw-semibold">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" 
                              class="form-control rounded-3 @error('alamat') is-invalid @enderror"
                              rows="3" placeholder="Masukkan alamat lengkap karyawan" required>{{ old('alamat') }}</textarea> {{-- Changed rows from 4 to 3 --}}
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-teal shadow-sm rounded-pill px-4"> {{-- Changed btn-lg to default btn --}}
                        <i class="bi bi-save-fill me-2"></i> Simpan Karyawan
                    </button>
                    <a href="{{ route('karyawan.index') }}" class="btn btn-outline-secondary rounded-pill px-4"> {{-- Changed btn-lg to default btn --}}
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