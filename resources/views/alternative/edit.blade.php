@extends('layouts.app') {{-- Assuming you have a layout file --}}

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Edit Tempat Billiard: {{ $alternative->name }}</h2>
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

            <form action="{{ route('alternative.update', $alternative->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Use PUT method for update operations --}}

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nama Tempat Billiard <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $alternative->name) }}" placeholder="Contoh: Billiard Corner" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label fw-bold">Alamat</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Masukkan alamat lengkap tempat billiard">{{ old('address', $alternative->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label fw-bold">Kontak</label>
                    <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" value="{{ old('contact', $alternative->contact) }}" placeholder="Contoh: 081234567890">
                    @error('contact')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Berikan deskripsi singkat tentang tempat billiard ini, fasilitas, dll.">{{ old('description', $alternative->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="open_hour" class="form-label fw-bold">Jam Buka</label>
                        <input type="time" class="form-control @error('open_hour') is-invalid @enderror" id="open_hour" name="open_hour" value="{{ old('open_hour', $alternative->open_hour ? \Carbon\Carbon::parse($alternative->open_hour)->format('H:i') : '') }}">
                        @error('open_hour')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="close_hour" class="form-label fw-bold">Jam Tutup</label>
                        <input type="time" class="form-control @error('close_hour') is-invalid @enderror" id="close_hour" name="close_hour" value="{{ old('close_hour', $alternative->close_hour ? \Carbon\Carbon::parse($alternative->close_hour)->format('H:i') : '') }}">
                        @error('close_hour')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="submit" class="btn btn-primary px-4">Update</button> {{-- Changed to btn-primary for update action --}}
                    <a href="{{ route('alternative.index') }}" class="btn btn-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
