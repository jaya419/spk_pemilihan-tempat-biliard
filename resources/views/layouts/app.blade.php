<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Aplikasi Penilaian Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f0f2f5; /* Lighter background for the body */
            font-size: 0.9rem; /* Smaller base font size for overall compact look */
        }
        main {
            flex: 1;
            padding-top: 1.5rem; /* Adjust main content padding */
            padding-bottom: 1.5rem;
        }

        /* --- Navbar Styles --- */
        .navbar {
            background-color: #0d47a1; /* Deep Blue - like a pool table */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); /* Stronger shadow for depth */
            padding: 0.3rem 0.8rem; /* Very compact vertical padding */
            border-bottom: 1px solid #0a3d91; /* Darker blue bottom border */
            transition: all 0.2s ease-in-out;
        }

        .navbar-brand {
            font-family: 'Arial Black', Gadget, sans-serif; /* More impactful font */
            font-weight: 800; /* Extra bold */
            font-size: 1.3rem; /* Slightly smaller brand text for compactness */
            color: #ffc107 !important; /* Amber/Gold - cue tip color */
            display: flex;
            align-items: center;
            gap: 0.4rem;
            transition: color 0.2s ease;
            letter-spacing: 0.5px; /* Slight letter spacing */
        }

        .navbar-brand i {
            font-size: 1.5rem; /* Smaller icon */
            color: #28a745; /* Green - pool felt color */
            transition: color 0.2s ease;
        }

        .navbar-brand:hover {
            color: #ffe082 !important; /* Lighter amber on hover */
            text-decoration: none;
        }

        .navbar-brand:hover i {
            color: #218838; /* Darker green on hover */
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.2) !important;
            padding: 0.2rem 0.4rem; /* Even smaller toggler */
            font-size: 0.75rem; /* Smaller toggler icon/text */
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.7%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        .nav-link {
            color: #e0e0e0 !important; /* Light grey for default links */
            font-weight: 500;
            padding: 0.3rem 0.6rem !important; /* Very compact link padding */
            transition: background-color 0.2s ease, color 0.2s ease, border-radius 0.2s ease;
            border-radius: 0.2rem; /* Slightly smaller border-radius */
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.85rem; /* Smaller font for links */
        }

        .nav-link:hover,
        .nav-link:focus {
            color: #fff !important; /* White on hover/focus */
            background-color: #1a56c7 !important; /* Lighter blue background on hover */
        }

        .nav-link.active {
            background-color: #28a745 !important; /* Green for active - pool felt */
            color: #fff !important;
            box-shadow: 0 1px 4px rgba(40, 167, 69, 0.4); /* Subtle shadow for active link */
        }

        .nav-link.active i {
            color: #fff !important; /* White icon for active */
        }

        .nav-link i {
            font-size: 1rem; /* Smaller icon size */
            color: #bbdefb; /* Very light blue for default icons */
            transition: color 0.2s ease;
        }

        .nav-link:hover i {
            color: #fff; /* White icon on hover */
        }

        /* Adjusted user profile icon styling */
        .user-profile-icon {
            font-size: 1.3rem; /* Smaller icon for compactness */
            color: #ffc107; /* Amber/Gold color for the icon */
            border: 2px solid #ffc107; /* Amber border */
            border-radius: 50%; /* Make it circular */
            padding: 0.1rem 0.3rem; /* Smaller padding inside the circular border */
            line-height: 1; /* Align icon vertically */
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px; /* Fixed width/height for circular shape */
            height: 32px;
            box-shadow: 0 0 4px rgba(255, 193, 7, 0.4); /* Subtle glow */
            transition: color 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .nav-item.dropdown:hover .user-profile-icon {
            color: #ffe082; /* Lighter amber icon on hover */
            border-color: #ffe082; /* Lighter amber border on hover */
            box-shadow: 0 0 6px rgba(255, 193, 7, 0.6); /* Enhanced glow on hover */
        }

        /* Dropdown menu styling */
        .dropdown-menu {
            background-color: #ffffff !important;
            border: 1px solid #dcdcdc;
            border-radius: 0.5rem; /* More rounded corners */
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1); /* Deeper shadow */
            min-width: 180px; /* Slightly narrower dropdown for compactness */
            padding: 0.4rem 0;
            animation: fadeInScale 0.2s ease-out; /* Add a subtle animation back */
        }

        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.95) translateY(-5px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .dropdown-item,
        .dropdown-item-text {
            color: #333 !important;
            padding: 0.5rem 1rem; /* Adjusted padding for dropdown items */
            transition: background-color 0.2s ease, color 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem; /* Smaller font for dropdown items */
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #f1f1f1 !important; /* Lighter grey on hover */
            color: #0d47a1 !important; /* Blue text on hover (matching navbar) */
        }

        .dropdown-divider {
            border-color: #f0f0f0 !important;
            margin: 0.4rem 0;
        }

        .dropdown-item .btn-link {
            color: #dc3545 !important;
            font-weight: 500;
        }

        .dropdown-item .btn-link:hover {
            color: #c82333 !important;
        }

        /* --- NEW Footer Styles (Updated to match Navbar colors) --- */
        .new-footer {
            background-color: #0d47a1; /* Deep Blue - Matches Navbar background */
            color: #e0e0e0; /* Light grey text */
            padding: 2.5rem 0 1.5rem;
            font-size: 0.8rem;
            border-top: 5px solid #28a745; /* Green felt color */
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.3);
        }

        .new-footer h5 {
            color: #ffc107; /* Amber/Gold for headings - Matches Navbar brand text */
            font-size: 1.1rem;
            margin-bottom: 1.2rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .new-footer p {
            color: #bbdefb; /* Light blue text - Harmonizes with link colors */
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .new-footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .new-footer ul li {
            margin-bottom: 0.8rem;
        }

        .new-footer ul li a {
            color: #e0e0e0; /* Light grey for links - Matches Navbar default links */
            text-decoration: none;
            transition: color 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .new-footer ul li a:hover {
            color: #ffc107; /* Amber/Gold on hover - Matches Navbar brand hover */
            text-decoration: underline;
        }

        .new-footer .social-icons a {
            display: inline-block;
            margin: 0 0.6rem;
            color: #ffc107; /* Amber/Gold for social icons */
            font-size: 1.4rem;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .new-footer .social-icons a:hover {
            color: #28a745; /* Green on hover - Matches Navbar brand icon */
            transform: translateY(-3px) scale(1.1);
        }

        .new-footer .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.15); /* Slightly more visible divider */
            padding-top: 1.2rem;
            margin-top: 2rem;
            font-size: 0.75rem;
            color: #bbdefb; /* Light blue for copyright text */
        }

        /* --- Responsive adjustments --- */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                padding: 0.6rem 0;
                background-color: #0d47a1; /* Ensure background consistency on collapse */
                border-top: 1px solid #0a3d91; /* Match top border */
            }

            .nav-item {
                margin: 0.2rem 0;
            }

            .nav-link {
                justify-content: flex-start;
                padding-left: 1rem !important;
            }

            .new-footer .footer-column {
                text-align: center;
                margin-bottom: 2rem;
            }
            .new-footer ul li a {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-bullseye"></i> <span class="d-none d-sm-inline">Pool Performance</span> <span class="d-inline d-sm-none">Pool App</span>
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-house-door-fill"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('alternative.*') ? 'active' : '' }}" href="{{ route('alternative.index') }}">
                            <i class="bi bi-people-fill"></i> Daftar tempat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kriteria.*') ? 'active' : '' }}" href="{{ route('kriteria.index') }}">
                            <i class="bi bi-journal-text"></i> Kriteria
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('score.calculateSAW') ? 'active' : '' }}" href="{{ route('score.calculateSAW') }}">
                            <i class="bi bi-bar-chart-fill"></i> Hasil penilaian
                        </a>
                    </li>

                    @auth
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle d-flex align-items-center"
                            href="#"
                            id="userDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="bi bi-person-circle user-profile-icon me-2"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li class="dropdown-item-text text-center">
                                <strong>{{ auth()->user()->name }}</strong><br />
                                <small class="text-muted">{{ auth()->user()->email }}</small>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0 m-0">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="btn btn-link text-danger w-100 text-start px-3 py-2 d-flex align-items-center"
                                    >
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>

    ---

    <footer class="new-footer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-6 footer-column text-center text-md-start">
                    <h5><i class="bi bi-bullseye me-2"></i>Pool Performance</h5>
                    <p>
                        Track and analyze player performance in billiards with our advanced ranking system. Improve your game and climb the leaderboard!
                    </p>
                </div>
                <div class="col-md-3 col-sm-6 footer-column text-center text-md-start">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i> Home</a></li>
                        <li><a href="{{ route('alternative.index') }}"><i class="bi bi-people"></i> Daftar tempat</a></li>
                        <li><a href="{{ route('kriteria.index') }}"><i class="bi bi-list-check"></i> Kriteria</a></li>
                        <li><a href="{{ route('score.calculateSAW') }}"><i class="bi bi-trophy"></i> Hasil penilaian</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 footer-column text-center text-md-start">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="bi bi-geo-alt-fill me-2"></i> Palu, Indonesia</a></li>
                        <li><a href="mailto:info@poolperformance.com"><i class="bi bi-envelope-fill me-2"></i> info@poolperformance.com</a></li>
                        <li><a href="tel:+6281234567890"><i class="bi bi-phone-fill me-2"></i> +62 812-3456-7890</a></li>
                    </ul>
                    <div class="social-icons mt-3">
                        <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center footer-bottom">
                <p class="mb-0">Pool Performance &copy; 2025. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>