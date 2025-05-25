@extends('layouts.app')

@section('title', 'Tambah Kriteria')

@section('content')
<div class="container-fluid py-3">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-teal text-white d-flex justify-content-between align-items-center py-3 rounded-top-4">
            <h2 class="h5 mb-0"><i class="bi bi-journal-plus me-2"></i> Tambah Kriteria Baru</h2> {{-- Icon changed to bi-journal-plus --}}
        </div>

        <div class="card-body p-3">
            @if ($errors->has('duplicate'))
                <div class="alert alert-danger">
                    {{ $errors->first('duplicate') }}
                </div>
            @endif
            <form action="{{ route('kriteria.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Kriteria</label>
                    <input type="text" name="nama" id="nama" 
                           class="form-control rounded-3 @error('nama') is-invalid @enderror" 
                           value="{{ old('nama') }}" placeholder="Contoh: Kedisiplinan, Kualitas Kerja" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="bobot" class="form-label fw-semibold">Bobot (%)</label>
                    <input type="number" name="bobot" id="bobot" 
                           class="form-control rounded-3 @error('bobot') is-invalid @enderror" 
                           value="{{ old('bobot') }}" min="1" max="100" placeholder="Masukkan bobot antara 1-100" required>
                    @error('bobot')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4"> {{-- Increased margin-bottom for spacing before buttons --}}
                    <label for="tipe" class="form-label fw-semibold">Tipe</label>
                    <select name="tipe" id="tipe" 
                            class="form-select rounded-3 @error('tipe') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih tipe (Cost/Benefit)</option>
                        <option value="cost" {{ old('tipe') == 'cost' ? 'selected' : '' }}>Cost</option>
                        <option value="benefit" {{ old('tipe') == 'benefit' ? 'selected' : '' }}>Benefit</option>
                    </select>
                    @error('tipe')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-teal shadow-sm rounded-pill px-4">
                        <i class="bi bi-save-fill me-2"></i> Simpan Kriteria
                    </button>
                    <a href="{{ route('kriteria.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-x-circle-fill me-2"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Custom Teal Color */
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