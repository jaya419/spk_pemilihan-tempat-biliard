@extends('layouts.app')

@section('title', 'Hasil Perhitungan SAW')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-teal text-white d-flex justify-content-between align-items-center py-3 rounded-top-4">
            <h2 class="h5 mb-0"><i class="bi bi-calculator-fill me-2"></i> Hasil Perhitungan SAW</h2>
        </div>

        <div class="card-body p-4">
            @php
                $hasilFiltered = array_filter($hasil, fn($item) => $item['skor'] > 0);
                usort($hasilFiltered, fn($a, $b) => $b['skor'] <=> $a['skor']);
                $highestScorer = !empty($hasilFiltered) ? $hasilFiltered[0] : null;
            @endphp

            @if(count($hasilFiltered))
            <div class="rounded-3 shadow-sm table-fade-in">
                <table class="table table-hover table-striped mb-0 border border-light-subtle">
                    <thead class="bg-gradient-teal text-white">
                        <tr>
                            <th scope="col" class="py-3 ps-4 text-center">No</th>
                            <th scope="col" class="py-3">Nama Karyawan</th>
                            <th scope="col" class="py-3 text-center">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(array_values($hasilFiltered) as $index => $data)
                        <tr class="align-middle table-row-hover">
                            <td class="fw-semibold ps-4 text-center">{{ $index + 1 }}</td>
                            <td class="fw-semibold">
                                {{ $data['karyawan'] }}
                                @if($data['karyawan'] === $highestScorer['karyawan'])
                                    <i class="bi bi-star-fill text-warning ms-2 animate__animated animate__bounceIn" title="Skor Tertinggi"></i>
                                @endif
                            </td>
                            <td class="text-center">{{ number_format($data['skor'], 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-info d-flex align-items-center rounded-3 p-4 shadow-sm" role="alert">
                <i class="bi bi-info-circle-fill me-3 fs-3"></i>
                <div>
                    <h5 class="alert-heading mb-2">Belum ada penilaian</h5>
                    <p class="mb-0">Silakan lakukan penilaian terhadap karyawan terlebih dahulu</p>
                </div>
            </div>
            @endif
        </div>

        @if($highestScorer)
        <div class="alert alert-success d-flex align-items-center rounded-3 p-3 shadow-sm mb-4 animate__animated animate__fadeInDown" role="alert">
            <i class="bi bi-award-fill me-3 fs-3"></i>
            <div>
                <h5 class="alert-heading mb-1">Karyawan Terbaik!</h5>
                <p class="mb-0">Selamat kepada <span class="fw-bold">{{ $highestScorer['karyawan'] }}</span> dengan skor tertinggi: <span class="fw-bold">{{ number_format($highestScorer['skor'], 2) }}</span>.</p>
            </div>
        </div>
        @endif
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

    .btn-outline-teal {
        color: #20c997;
        border-color: #20c997;
    }

    .btn-outline-teal:hover {
        color: #fff;
        background-color: #20c997;
        border-color: #20c997;
    }

    .bg-gradient-teal {
        background: linear-gradient(to right, #20c997, #1abc9c);
    }

    .table-row-hover:hover {
        background-color: rgba(32, 201, 151, 0.1);
        transform: scale(1.005);
        transition: all 0.2s ease-in-out;
    }

    .hover-scale {
        transition: transform 0.2s ease-in-out;
    }

    .hover-scale:hover {
        transform: scale(1.1);
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

    .table-fade-in {
        animation: fadeIn 0.6s ease-out forwards;
    }

    @import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
</style>
@endsection
