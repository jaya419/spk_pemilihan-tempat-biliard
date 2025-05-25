<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #e0e7eb; /* Lighter, subtle background */
        }

        .login-section {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .left-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: linear-gradient(to right, #4a90e2, #7b68ee); /* Gradient background */
        }

        .left-side img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.8; /* Slightly transparent image */
        }

        .right-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            padding: 2rem;
        }

        .login-card {
            background-color: #fff;
            padding: 3rem; /* Increased padding */
            border-radius: 1.5rem; /* More rounded corners */
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15); /* Stronger, softer shadow */
            width: 100%;
            max-width: 450px; /* Slightly wider card */
            transform: translateY(0);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .form-control {
            border-radius: 0.75rem; /* Rounded input fields */
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(74, 144, 226, 0.25); /* Blue focus ring */
            border-color: #4a90e2; /* Blue border on focus */
        }

        .btn-primary {
            background-color: #4a90e2; /* Custom primary blue */
            border: none;
            border-radius: 0.75rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: background-color 0.2s ease-in-out, transform 0.1s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #357ABD; /* Darker blue on hover */
            transform: translateY(-2px); /* Slight lift on hover */
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .text-link a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease-in-out, text-decoration 0.2s ease-in-out;
        }

        .text-link a:hover {
            color: #357ABD;
            text-decoration: underline;
        }

        .text-muted {
            color: #6c757d !important; /* Ensure proper muted color */
            font-size: 0.95rem;
        }

        .alert {
            border-radius: 0.75rem;
            font-size: 0.9rem;
            padding: 0.75rem 1.25rem;
        }

        @media (max-width: 768px) {
            .login-section {
                flex-direction: column;
            }

            .left-side {
                display: none; /* Hide image on smaller screens */
            }

            .right-side {
                flex: unset;
                height: 100vh;
                padding: 1.5rem;
                background-color: #f0f2f5; /* Match body background on mobile */
            }

            .login-card {
                box-shadow: none;
                padding: 2rem;
                border-radius: 0;
                max-width: 100%;
                transform: none; /* Remove transform on mobile */
            }
             .login-card:hover {
                transform: none;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>

<div class="login-section">
    <div class="left-side">
        <img src="{{ asset('foto/office.jpg') }}" alt="Login Illustration">
    </div>
    <div class="right-side">
        <div class="login-card">
            <h3 class="mb-3 text-center fw-bold" style="color: #4a90e2;">Selamat Datang Kembali!</h3> <p class="text-muted text-center mb-4">Silakan login terlebih dahulu untuk masuk ke sistem.</p> @if (session('status'))
                <div class="alert alert-success text-center">{{ session('status') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger text-center">{{ session('error') }}</div>
            @endif

            <form action="{{ route('loginproccess') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">Masuk</button>
                </div>
            </form>

            <div class="text-center mt-4 text-link">
                Belum punya akun? <a href="{{ route('auth.register') }}">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>