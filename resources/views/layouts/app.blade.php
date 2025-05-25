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
            min-height: 100vh; /* Ensures the footer stays at the bottom */
        }
        main {
            flex: 1; /* Allows main content to grow and push footer down */
        }
        .navbar {
            background-color: #2c3e50;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 1rem;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.4rem;
            color: #ecf0f1 !important;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .navbar-brand i {
            font-size: 1.5rem;
            color: #1abc9c;
        }

        .navbar-brand:hover {
            color: #16a085 !important;
            text-decoration: none;
        }

        .nav-link {
            color: #ecf0f1 !important;
            font-weight: 500;
            padding: 0.4rem 0.8rem !important;
            transition: background-color 0.2s ease;
            border-radius: 0.3rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .nav-link:hover,
        .nav-link:focus,
        .nav-link.active {
            background-color: #16a085 !important;
            color: #fff !important;
            text-decoration: none;
        }

        .nav-link i {
            font-size: 1.1rem;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #16a085;
            transition: border-color 0.3s ease;
        }

        .nav-item.dropdown:hover .user-avatar {
            border-color: #1abc9c;
        }

        /* Dropdown putih dengan teks gelap */
        .dropdown-menu {
            background-color: #fff !important;
            border: 1px solid #ddd;
            border-radius: 0.4rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            min-width: 200px;
        }

        .dropdown-item,
        .dropdown-item-text {
            color: #333 !important;
            padding: 0.5rem 1rem;
            transition: background-color 0.2s ease;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #e9ecef !important;
            color: #000 !important;
        }

        .dropdown-divider {
            border-color: #ddd !important;
        }

        /* Footer Styles */
        .footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 1.5rem 0;
            margin-top: auto; /* Pushes the footer to the bottom */
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.1);
        }

        .footer a {
            color: #1abc9c;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer a:hover {
            color: #16a085;
            text-decoration: underline;
        }

        .footer .social-icons i {
            font-size: 1.5rem;
            margin: 0 0.5rem;
            color: #ecf0f1;
            transition: color 0.2s ease;
        }

        .footer .social-icons i:hover {
            color: #1abc9c;
        }


        @media (max-width: 991.98px) {
            .navbar-collapse {
                padding: 0.8rem 0;
            }

            .nav-item {
                margin: 0.25rem 0;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand">
                <i class="bi bi-award-fill"></i>
                Hi Admin
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
                        <a class="nav-link {{ request()->routeIs('beranda.index') ? 'active' : '' }}" href="{{ route('beranda.index') }}">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('karyawan.index') ? 'active' : '' }}" href="{{ route('karyawan.index') }}">
                            <i class="bi bi-people-fill"></i> Karyawan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kriteria.index') ? 'active' : '' }}" href="{{ route('kriteria.index') }}">
                            <i class="bi bi-list-check"></i> Kriteria
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('hasil.index') ? 'active' : '' }}" href="{{ route('hasil.index') }}">
                            <i class="bi bi-bar-chart-line-fill"></i> Hasil
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
                            <img
                                src="{{ asset('foto/' . auth()->user()->profile_picture) }}"
                                alt="User Avatar"
                                class="user-avatar me-2"
                            />
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

    <footer class="footer">
        <div class="container text-center">
            <p class="mb-2">
                Aplikasi Penilaian Karyawan &copy; 2025. All rights reserved.
            </p>
            <div class="social-icons">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>