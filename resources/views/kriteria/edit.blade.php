@extends('layouts.app')

@section('title', 'Edit Kriteria')

@section('content')
<div class="container-fluid py-3">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-teal text-white d-flex justify-content-between align-items-center py-3 rounded-top-4">
            <h2 class="h5 mb-0"><i class="bi bi-journal-check me-2"></i> Edit Data Kriteria</h2> {{-- Icon changed to bi-journal-check --}}
        </div>

        <div class="card-body p-3">
            @if ($errors->has('duplicate'))
                <div class="alert alert-danger">
                    {{ $errors->first('duplicate') }}
                </div>
            @endif
            <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Essential for update operations --}}

                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Kriteria</label>
                    <input type="text" name="nama" id="nama" 
                           class="form-control rounded-3 @error('nama') is-invalid @enderror" 
                           value="{{ old('nama', $kriteria->nama) }}" placeholder="Contoh: Kedisiplinan, Kualitas Kerja" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="bobot" class="form-label fw-semibold">Bobot (%)</label>
                    <input type="number" name="bobot" id="bobot" 
                           class="form-control rounded-3 @error('bobot') is-invalid @enderror" 
                           value="{{ old('bobot', $kriteria->bobot) }}" min="1" max="100" placeholder="Masukkan bobot antara 1-100" required>
                    @error('bobot')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4"> {{-- Increased margin-bottom for spacing before buttons --}}
                    <label for="tipe" class="form-label fw-semibold">Tipe</label>
                    <select name="tipe" id="tipe" 
                            class="form-select rounded-3 @error('tipe') is-invalid @enderror" required>
                        <option value="cost" {{ (old('tipe', $kriteria->tipe) == 'cost') ? 'selected' : '' }}>Cost</option>
                        <option value="benefit" {{ (old('tipe', $kriteria->tipe) == 'benefit') ? 'selected' : '' }}>Benefit</option>
                    </select>
                    @error('tipe')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-teal shadow-sm rounded-pill px-4">
                        <i class="bi bi-arrow-clockwise me-2"></i> Update Kriteria
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