@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Edit Kriteria: {{ $kriteria->name }}</h2>
        </div>
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        @if ($errors->has('duplicate'))
                            <li>{{ $errors->first('duplicate') }}</li>
                        @endif
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nama Kriteria <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $kriteria->name) }}" placeholder="Contoh: Harga, Jarak, Fasilitas" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="weight" class="form-label fw-bold">Bobot <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight', $kriteria->weight) }}" min="0.01" max="1" placeholder="Contoh: 0.25" required>
                    <div class="form-text">Masukkan bobot dalam bentuk desimal (0 - 1), contoh: 0.25 untuk 25%.</div>
                    @error('weight')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label fw-bold">Tipe <span class="text-danger">*</span></label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="">Pilih Tipe</option>
                        <option value="cost" {{ old('type', $kriteria->type) == 'cost' ? 'selected' : '' }}>Cost (Biaya)</option>
                        <option value="benefit" {{ old('type', $kriteria->type) == 'benefit' ? 'selected' : '' }}>Benefit (Keuntungan)</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="submit" class="btn btn-primary px-4">Update</button>
                    <a href="{{ route('kriteria.index') }}" class="btn btn-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
