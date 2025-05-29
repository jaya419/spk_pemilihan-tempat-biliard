@extends('layouts.app') {{-- Gunakan layout utama --}}

@section('content')
<div class="container py-3">

    {{-- ======= JIKA BELUM ADA HASIL PENILAIAN ======= --}}
    @if (empty($results) || count($results) === 0)
        <div class="alert alert-info alert-dismissible fade show animate__animated animate__fadeInDown py-2" role="alert">
            <h5 class="alert-heading fs-6 mb-1">
                <i class="fas fa-info-circle me-2"></i> Informasi Penting!
            </h5>
            Belum ada hasil perhitungan. Pastikan Anda telah mengisi <strong>penilaian untuk semua alternatif dan kriteria</strong> terlebih dahulu.
            <hr class="my-2">
            <p class="mb-0 small">Silakan menuju halaman penilaian untuk memulai perhitungan.</p>
            <div class="d-flex justify-content-center mt-2">
                <a href="{{ route('score.index') }}" class="btn btn-primary btn-sm animate__animated animate__pulse">
                    <i class="fas fa-edit me-2"></i> Mulai Penilaian
                </a>
            </div>
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    {{-- ======= JIKA SUDAH ADA HASIL PENILAIAN ======= --}}
    @else
        {{-- Tabel Peringkat Lengkap --}}
        <div class="card shadow-sm animate__animated animate__fadeInUp">
            <div class="card-header bg-primary text-white py-2">
                <h4 class="mb-0 fs-6">
                    <i class="fas fa-list-ol me-2"></i> Peringkat Lengkap Alternatif
                </h4>
            </div>

            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-start align-middle table-sm">
                        <thead class="table-primary">
                            <tr>
                                <th class="text-center" style="width: 50px;">Peringkat</th>
                                <th style="min-width: 150px;">Nama Alternatif</th>
                                <th class="text-center" style="min-width: 80px;">Nilai SAW</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $index => $result)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $result['alternative'] }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $index === 0 ? 'bg-success' : 'bg-secondary' }} fs-6">
                                            {{ number_format($result['score'], 2) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end py-2">
                <a href="{{ route('score.index') }}" class="btn btn-primary btn-md animate__animated animate__pulse">
                    <i class="fas fa-undo-alt me-2"></i> Kembali ke Penilaian
                </a>
            </div>
        </div>

        {{-- Card Hasil Terbaik --}}
        <div class="card bg-primary text-white shadow-sm mb-3 mt-3 animate__animated animate__fadeInDown">
            <div class="card-body py-2 text-start">
                <div class="d-flex align-items-center">
                    <i class="fas fa-crown me-2 fs-5 animate__animated animate__tada" style="--animate-delay: 0.5s;"></i>
                    <div>
                        <h5 class="card-title mb-0 fs-6">
                            Alternatif Terbaik Pilihan Sistem: {{ $results[0]['alternative'] }}
                        </h5>
                        <p class="card-text fs-6 mb-0 mt-1">
                            Dengan:
                            <span class="badge bg-light text-primary fs-6 shadow-sm">
                                {{ number_format($results[0]['score'], 2) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    /* Utility adjustments agar tampilan lebih ringkas */
    .container.py-3    { padding-top: .5rem!important; padding-bottom: .5rem!important; }
    .py-2             { padding-top: .5rem!important; padding-bottom: .5rem!important; }
    .my-2             { margin-top: .5rem!important; margin-bottom: .5rem!important; }
    .mt-3             { margin-top: 1rem!important; }
    .table-sm th,
    .table-sm td      { padding-top: .3rem; padding-bottom: .3rem; font-size: .85rem; }

    /* Sticky header tabel */
    .table thead.sticky-top th{
        position: sticky; top: 0; background:#f8f9fa; z-index:10;
        box-shadow: 0 2px 2px -1px rgba(0,0,0,.1);
    }
</style>
@endpush
