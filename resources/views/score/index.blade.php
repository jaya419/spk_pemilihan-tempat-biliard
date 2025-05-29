@extends('layouts.app') {{-- Assuming you have a layout file --}}

@section('content')
<div class="container py-4">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show animate__animated animate__shakeX" role="alert">
            <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i> Ada kesalahan dalam pengisian:</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($alternatives->isEmpty() || $criterias->isEmpty())
        <div class="alert alert-warning alert-dismissible fade show animate__animated animate__fadeInUp" role="alert">
            <h5 class="alert-heading"><i class="fas fa-info-circle me-2"></i> Perhatian!</h5>
            Anda perlu menambahkan setidaknya satu Alternatif dan satu Kriteria sebelum dapat melakukan penilaian.
            <hr>
            <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                @if ($alternatives->isEmpty())
                    <a href="{{ route('alternative.create') }}" class="btn btn-primary animate__animated animate__pulse animate__infinite">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Alternatif Baru
                    </a>
                @endif
                @if ($criterias->isEmpty())
                    <a href="{{ route('kriteria.create') }}" class="btn btn-info text-white animate__animated animate__pulse animate__infinite">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Kriteria Baru
                    </a>
                @endif
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else
        <div class="card shadow-sm animate__animated animate__fadeInUp">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i> Input Penilaian Alternatif per Kriteria</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('score.store') }}" method="POST">
                    @csrf
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-hover text-center align-middle caption-top">
                            <caption class="text-start mb-2">Isi nilai untuk setiap alternatif berdasarkan kriteria (0-100)</caption>
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th style="width: 50px;">No</th> {{-- Added No column --}}
                                    <th class="text-start" style="min-width: 150px;">Alternatif</th>
                                    @foreach ($criterias as $criterion)
                                        <th style="min-width: 120px;">
                                            {{ $criterion->name }} <br> <small class="text-muted">({{ $criterion->weight }}%)</small>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alternatives as $index => $alternative) {{-- Added $index to use $loop->iteration --}}
                                    <tr>
                                        <td>{{ $index + 1 }}</td> {{-- Display loop iteration (No) --}}
                                        <td class="text-start fw-bold">
                                            {{ $alternative->name }}
                                            <input type="hidden" name="alternative_ids[]" value="{{ $alternative->id }}">
                                        </td>
                                        @foreach ($criterias as $criterion)
                                            <td>
                                                @php
                                                    $scoreKey = $alternative->id . '-' . $criterion->id;
                                                    $currentValue = $scores->has($scoreKey) ? $scores[$scoreKey]->value : '';
                                                @endphp
                                                <input
                                                    type="number"
                                                    name="value[{{ $alternative->id }}][{{ $criterion->id }}]"
                                                    class="form-control form-control-sm text-center
                                                    @error('value.' . $alternative->id . '.' . $criterion->id) is-invalid @enderror"
                                                    value="{{ old('value.' . $alternative->id . '.' . $criterion->id, $currentValue) }}"
                                                    min="0"
                                                    max="100"
                                                    required
                                                    placeholder="0-100"
                                                >
                                                @error('value.' . $alternative->id . '.' . $criterion->id)
                                                    <div class="invalid-feedback text-start">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success btn-lg shadow-sm animate__animated animate__pulse animate__infinite">
                            <i class="fas fa-save me-2"></i> Simpan Penilaian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        .table thead.sticky-top th {
            position: sticky;
            top: 0;
            background-color: #f8f9fa; /* Match table-light background */
            z-index: 10; /* Ensure it stays above content when scrolling */
            box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.1);
        }
        .form-control-sm {
            height: calc(1.8em + 0.5rem + 2px); /* Adjust height for better fit in table cells */
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Optional: Add some JavaScript for a more interactive feel if needed
        // For example, dynamic calculations or more complex validation
    </script>
@endpush