@extends('layouts.app') {{-- Assuming you have a layout file --}}

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-xl overflow-hidden animate__animated animate__fadeIn">
        <div class="card-header bg-gradient-primary text-white text-center py-5">
            <h1 class="mb-2 display-3 fw-bolder" style="font-family: 'Montserrat', sans-serif;">The Sunny Break Dashboard</h1>
            <p class="lead mb-0 text-white-75">Your central hub for managing pool cue data and performance metrics.</p>
        </div>
        <div class="card-body p-5">
            <div class="row text-center mb-5 gx-4">
                {{-- Total Alternatives Card --}}
                <div class="col-md-4 mb-4">
                    <div class="card bg-white text-dark shadow-hover h-100 border-start-primary rounded-lg">
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h5 class="card-title text-primary fw-bold mb-1">Daftar tempat</h5>
                                    <p class="card-text display-4 fw-bolder text-dark">{{ $alternativeCount }}</p>
                                </div>
                                <i class="fas fa-billiard fa-5x text-primary-light opacity-50"></i>
                            </div>
                            <p class="card-text text-muted small mt-auto">
                                @if ($latestAlternative)
                                    Latest: <strong class="text-dark">{{ $latestAlternative->name }}</strong>
                                @else
                                    No cues added yet. Time to rack 'em up!
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Total Criteria Card --}}
                <div class="col-md-4 mb-4">
                    <div class="card bg-white text-dark shadow-hover h-100 border-start-success rounded-lg">
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h5 class="card-title text-success fw-bold mb-1">Jumlah kriteria</h5>
                                    <p class="card-text display-4 fw-bolder text-dark">{{ $criterionCount }}</p>
                                </div>
                                <i class="fas fa-list-ol fa-5x text-success-light opacity-50"></i>
                            </div>
                            <p class="card-text text-muted small mt-auto">
                                @if ($latestCriterion)
                                    Latest: <strong class="text-dark">{{ $latestCriterion->name }}</strong>
                                @else
                                    No factors defined. Set your rules!
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Total Scores Card --}}
                <div class="col-md-4 mb-4">
                    <div class="card bg-white text-dark shadow-hover h-100 border-start-info rounded-lg">
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h5 class="card-title text-info fw-bold mb-1">Hasil penilaian</h5>
                                    <p class="card-text display-4 fw-bolder text-dark">{{ $scoreCount }}</p>
                                </div>
                                <i class="fas fa-calculator fa-5x text-info-light opacity-50"></i>
                            </div>
                            <p class="card-text text-muted small mt-auto">
                                @if ($latestScore)
                                    Last: <strong class="text-dark">{{ $latestScore->alternative->name }}</strong> on <strong class="text-dark">{{ $latestScore->criterion->name }}</strong> (Score: {{ $latestScore->value }})
                                @else
                                    No shots assessed yet. Time to make some calls!
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-5 border-top-2 border-light">

            <div class="row gx-4">
                {{-- Top 3 Ranked Alternatives Section --}}
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm h-100 border-0 rounded-lg animate__animated animate__fadeInLeft">
                        <div class="card-header bg-gradient-warning text-dark py-3 rounded-top-lg d-flex align-items-center justify-content-center">
                            <h4 class="card-title mb-0 text-center fw-bold" style="font-family: 'Montserrat', sans-serif;">3 Tempat terbaik</h4>
                            <i class="fas fa-trophy ms-3 fa-2x text-white-75"></i>
                        </div>
                        <div class="card-body p-4">
                            @if (!empty($top3RankedAlternatives))
                                <ul class="list-group list-group-flush border-radius-custom">
                                    @foreach ($top3RankedAlternatives as $index => $result)
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-3 bg-white border-bottom-dashed list-item-hover">
                                            <span class="fw-bold text-dark fs-5">{{ $index + 1 }}. {{ $result['alternative'] }}</span>
                                            <span class="badge bg-warning text-dark rounded-pill fs-6 px-4 py-2 shadow-sm">{{ number_format($result['score'], 2) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-center text-muted m-0 p-4">No rankings available yet. Assess some shots to see the top performers!</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Newly Added Alternatives Section --}}
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm h-100 border-0 rounded-lg animate__animated animate__fadeInRight">
                        <div class="card-header bg-gradient-secondary text-white py-3 rounded-top-lg d-flex align-items-center justify-content-center">
                            <h4 class="card-title mb-0 text-center fw-bold" style="font-family: 'Montserrat', sans-serif;">Baru ditambahkan</h4>
                            <i class="fas fa-plus-circle ms-3 fa-2x text-white-75"></i>
                        </div>
                        <div class="card-body p-4">
                            @if ($newlyAddedAlternatives->isNotEmpty())
                                <ul class="list-group list-group-flush border-radius-custom">
                                    @foreach ($newlyAddedAlternatives as $alternative)
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-3 bg-white border-bottom-dashed list-item-hover">
                                            <span class="fw-bold text-dark fs-5">{{ $alternative->name }}</span>
                                            @if ($alternative->created_at)
                                                <small class="text-muted">Added: {{ $alternative->created_at->diffForHumans() }}</small>
                                            @else
                                                <small class="text-muted">Added: N/A</small>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-center text-muted m-0 p-4">No new cues added recently. Start by adding your first cue!</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Google Fonts Import */
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap');

    body {
        background-color: #f0f2f5; /* A softer, light gray for the background */
        font-family: 'Open Sans', sans-serif;
        color: #343a40; /* Darker text for better contrast */
    }

    .container {
        max-width: 1200px;
    }

    .card {
        border: none;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.08); /* More pronounced initial shadow */
    }

    .card.shadow-hover:hover {
        transform: translateY(-5px); /* Lift card slightly on hover */
        box-shadow: 0 1.25rem 2.5rem rgba(0, 0, 0, 0.15) !important; /* Enhanced shadow on hover */
    }

    .rounded-xl {
        border-radius: 1.25rem !important; /* Larger border-radius for softer edges */
    }

    .card-header {
        border-bottom: none; /* Remove default card header border */
    }

    /* Gradient Backgrounds */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }
    .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107, #e0a800);
    }
    .bg-gradient-secondary {
        background: linear-gradient(135deg, #6c757d, #5a6268);
    }

    /* Border Left Colors for Info Cards */
    .border-start-primary { border-left: 0.5rem solid #007bff !important; }
    .border-start-success { border-left: 0.5rem solid #28a745 !important; }
    .border-start-info { border-left: 0.5rem solid #17a2b8 !important; }

    /* Lighter Icon Colors */
    .text-primary-light { color: rgba(140, 189, 252, 0.7) !important; }
    .text-success-light { color: rgba(130, 224, 150, 0.7) !important; }
    .text-info-light { color: rgba(136, 220, 235, 0.7) !important; }

    /* Font sizes and weights */
    h1, h4 {
        font-family: 'Montserrat', sans-serif;
    }
    .display-3 { font-size: 3.5rem; }
    .display-4 { font-size: 2.75rem; }
    .fs-1 { font-size: 4rem !important; } /* Larger numbers for key metrics */
    .fw-bolder { font-weight: 800 !important; } /* Extra bold for emphasis */

    /* List group styling */
    .list-group-flush .list-group-item {
        border-right: 0;
        border-left: 0;
        padding: 1rem 1.5rem;
    }
    .list-group-flush .list-group-item:first-child {
        border-top: 0;
    }
    .list-group-flush .list-group-item:last-child {
        border-bottom: 0;
    }
    .border-bottom-dashed {
        border-bottom: 1px dashed rgba(0, 0, 0, 0.1) !important; /* Dashed separator */
    }
    .list-item-hover:hover {
        background-color: #f8f9fa; /* Subtle highlight on list item hover */
        transform: translateX(5px); /* Slight shift to the right */
        transition: all 0.2s ease-in-out;
    }

    .border-radius-custom {
        border-radius: 0.75rem; /* Rounded corners for the list groups */
        overflow: hidden; /* Ensures contents respect border radius */
    }

    .hr.my-5 {
        border-top: 3px solid rgba(0, 0, 0, 0.05); /* Thicker, lighter separator */
    }

    /* Animation effects (requires animate.css library or similar) */
    /* Add this to your HTML <head> if you want animations:
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    */
</style>
@endsection