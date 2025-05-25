@extends('layouts.app')
@section('content')
<div class="container-fluid py-4 page-fade"> {{-- Transisi Fade --}}
    {{-- Hero Section --}}
    <div class="p-5 mb-4 bg-white text-dark rounded-4 shadow-lg border-start border-primary border-5 animate__animated animate__fadeInDown office-banner-hover">
        <div class="d-flex align-items-center">
            <div class="me-4 text-primary office-icon-zoom">
                <i class="fas fa-building fa-3x"></i>
            </div>
            <div>
                <h1 class="display-5 fw-bold mb-2">Selamat Datang di Sistem Penilaian Kinerja Karyawan</h1>
                <p class="fs-5 text-muted">Aplikasi ini mengimplementasikan metode <strong class="text-primary">Simple Additive Weighting (SAW)</strong> untuk penilaian yang akurat dan objektif. Kelola data, definisikan kriteria, dan hasilkan perangkingan kinerja terbaik dengan mudah!</p>
            </div>
        </div>
    </div>

    {{-- Info Cards Section --}}
    <div class="row mb-4">
        @php
            $cards = [
                ['color' => 'primary', 'icon' => 'users', 'label' => 'Total Karyawan', 'value' => $jumlahKaryawan ?? 0, 'route' => 'karyawan.index', 'description' => 'Jumlah seluruh karyawan yang tercatat.'],
                ['color' => 'success', 'icon' => 'clipboard-list', 'label' => 'Kriteria Penilaian', 'value' => $jumlahKriteria ?? 0, 'route' => 'kriteria.index', 'description' => 'Kriteria standar yang digunakan dalam evaluasi kinerja.'],
                ['color' => 'warning', 'icon' => 'chart-line', 'label' => 'Hasil Penilaian', 'value' => $jumlahPenilaian ?? 0, 'route' => 'penilaian.index', 'description' => 'Total laporan penilaian kinerja yang telah direkam.']
            ];
        @endphp
        @foreach($cards as $index => $card)
        <div class="col-12 col-md-4 mb-4 animate__animated animate__zoomIn animate__delay-{{ $index * 0.1 }}s">
            <a href="{{ route($card['route']) }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100 office-card-effect" style="--card-color: var(--bs-{{ $card['color'] }});">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="icon-square bg-{{ $card['color'] }} text-white me-3">
                            <i class="fas fa-{{ $card['icon'] }}"></i>
                        </div>
                        <div>
                            <h6 class="text-{{ $card['color'] }} text-uppercase fw-bold mb-1">{{ $card['label'] }}</h6>
                            <h3 class="text-dark fw-bolder mb-1">{{ $card['value'] }}</h3>
                            <p class="text-muted small mb-0">{{ $card['description'] }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <hr class="my-5">

    {{-- Activity Log Section --}}
    <div class="card shadow-lg mb-5 animate__animated animate__fadeInUp rounded-4">
        <div class="card-header bg-white border-bottom-0 py-4 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-history me-2"></i>Log Aktivitas Kinerja</h5>
            <span class="badge bg-secondary-subtle text-secondary py-2 px-3 rounded-pill">Pembaruan Real-time</span>
        </div>
        <div class="card-body px-4 pb-4">
            <div class="timeline position-relative ps-4">
                @php
                    $activities = [
                        ['model' => $karyawanTerbaru ?? null, 'icon' => 'user-tie', 'color' => 'info', 'title' => 'Karyawan Baru Ditambahkan', 'desc_prefix' => '', 'desc_suffix' => ' kini terdaftar untuk evaluasi kinerja.', 'field' => 'nama'],
                        ['model' => $kriteriaTerbaru ?? null, 'icon' => 'tasks', 'color' => 'success', 'title' => 'Kriteria Evaluasi Diperbarui', 'desc_prefix' => 'Kriteria penilaian "', 'desc_suffix' => '" telah disesuaikan.', 'field' => 'nama'],
                        ['model' => $penilaianTerbaru ?? null, 'icon' => 'star', 'color' => 'warning', 'title' => 'Penilaian Kinerja Terbaru', 'desc_prefix' => 'Kinerja ', 'desc_suffix' => ' telah berhasil dievaluasi.', 'field' => 'karyawan->nama']
                    ];
                @endphp

                @foreach($activities as $index => $activity)
                    @if($activity['model'])
                    <div class="timeline-item mb-4 animate__animated animate__fadeInRight animate__delay-{{ $index * 0.1 }}s">
                        <div class="timeline-marker bg-{{ $activity['color'] }}">
                            <i class="fas fa-{{ $activity['icon'] }} text-white"></i>
                        </div>
                        <div class="timeline-content p-3 rounded-3 shadow-sm border-start border-{{ $activity['color'] }} border-3">
                            <h6 class="fw-bold text-{{ $activity['color'] }} mb-1">{{ $activity['title'] }}</h6>
                            <p class="text-dark mb-1">
                                {{ $activity['desc_prefix'] }}
                                @if($activity['field'] === 'karyawan->nama')
                                    {{ optional(optional($activity['model'])->karyawan)->nama }}
                                @else
                                    {{ optional($activity['model'])->{$activity['field']} }}
                                @endif
                                {{ $activity['desc_suffix'] }}
                            </p>
                            <small class="text-secondary text-end d-block mt-2"><i class="far fa-clock me-1"></i>{{ $activity['model']->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    @endif
                @endforeach

                @if(!($karyawanTerbaru ?? null) && !($kriteriaTerbaru ?? null) && !($penilaianTerbaru ?? null))
                <div class="text-center py-5 animate__animated animate__fadeIn animate__delay-0.3s">
                    <i class="fas fa-box-open fa-4x text-gray-300 mb-3"></i>
                    <p class="text-gray-500 fw-light">Belum ada aktivitas terkait kinerja yang tercatat saat ini.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    body {
        background-color: #f0f2f5;
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    .container-fluid {
        max-width: 1300px;
    }

    .shadow-lg {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
    }

    .rounded-4 {
        border-radius: 1.25rem !important;
    }

    .text-primary { color: var(--bs-primary) !important; }
    .text-success { color: var(--bs-success) !important; }
    .text-warning { color: var(--bs-warning) !important; }
    .text-info { color: var(--bs-info) !important; }
    .text-secondary { color: var(--bs-secondary) !important; }
    .text-muted { color: #7c889a !important; }
    .text-gray-300 { color: #ced4da !important; }
    .text-gray-500 { color: #adb5bd !important; }

    .office-banner-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .office-banner-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.12) !important;
    }
    .office-icon-zoom {
        transition: transform 0.3s ease;
    }
    .office-banner-hover:hover .office-icon-zoom {
        transform: scale(1.1);
    }

    .office-card-effect {
        border: none;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
        overflow: hidden;
    }

    .office-card-effect::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(to right, var(--card-color, var(--bs-primary)), transparent);
        transform: translateY(-100%);
        transition: transform 0.3s ease-in-out;
    }

    .office-card-effect:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }

    .office-card-effect:hover::before {
        transform: translateY(0);
    }

    .icon-square {
        width: 70px;
        height: 70px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }

    .icon-square::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        transform: scale(0);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    .office-card-effect:hover .icon-square::after {
        transform: scale(1);
        opacity: 1;
    }

    .timeline {
        position: relative;
        padding-left: 35px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 4px;
        background: #e9ecef;
        border-radius: 5px;
    }

    .timeline-marker {
        position: absolute;
        left: 0;
        top: 0;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
        border: 3px solid #ffffff;
        font-size: 0.9rem;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 25px;
        transition: all 0.2s ease-in-out;
    }

    .timeline-item:hover {
        background-color: rgba(0, 123, 255, 0.03);
        transform: translateX(5px);
        border-radius: 0.85rem;
    }

    .timeline-content {
        background: #ffffff;
        border-radius: 0.85rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-left: 20px;
        position: relative;
    }

    .timeline-content::before {
        content: '';
        position: absolute;
        top: 50%;
        left: -10px;
        transform: translateY(-50%) rotate(45deg);
        width: 18px;
        height: 18px;
        background: #ffffff;
        z-index: 0;
    }

    .badge {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .fw-light {
        font-weight: 300 !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .timeline {
            padding-left: 25px;
        }
        .timeline-marker {
            left: -5px;
            width: 28px;
            height: 28px;
        }
        .timeline-content {
            margin-left: 15px;
        }
    }

    /* Page Fade Effect */
    .page-fade {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .page-fade.loaded {
        opacity: 1;
        transform: translateY(0);
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Dashboard scripts loaded.');
        document.querySelector('.page-fade')?.classList.add('loaded');
    });
</script>
@endsection