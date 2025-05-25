<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif; /* Modern font */
            background-color: #e0e7eb; /* Lighter, subtle background */
        }
        .register-section {
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
            background: linear-gradient(to right, #4a90e2, #7b68ee); /* Gradient background for left side */
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
            padding: 3rem;
            background-color: #ffffff; /* Clean white background for the form side */
        }
        .register-card {
            background-color: #ffffff;
            padding: 3rem; /* Increased padding */
            border-radius: 1.5rem; /* More rounded corners */
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15); /* Stronger, softer shadow */
            width: 100%;
            max-width: 480px;
            transform: translateY(0);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .register-card:hover {
            transform: translateY(-5px); /* Lift on hover */
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
        }
        .register-title {
            font-size: 2rem; /* Larger title */
            font-weight: 700; /* Bolder title */
            margin-bottom: 1.5rem; /* More space below title */
            text-align: center;
            color: #4a90e2; /* Matching primary blue */
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-title i {
            font-size: 2.2rem; /* Larger icon */
            margin-right: 0.75rem;
        }
        .form-label {
            font-weight: 500;
            color: #343a40; /* Darker label color */
        }
        .form-control {
            border-radius: 0.75rem; /* Rounded input fields */
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .form-control:focus {
            border-color: #4a90e2; /* Blue border on focus */
            box-shadow: 0 0 0 0.25rem rgba(74, 144, 226, 0.25); /* Blue focus ring */
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
            font-weight: 600; /* Bolder link text */
            transition: color 0.2s ease-in-out, text-decoration 0.2s ease-in-out;
        }
        .text-link a:hover {
            color: #357ABD;
            text-decoration: underline;
        }
        .text-muted {
            color: #6c757d !important;
            font-size: 0.95rem;
        }

        /* Media queries for responsiveness */
        @media (max-width: 768px) {
            .register-section {
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
            .register-card {
                box-shadow: none;
                padding: 2rem;
                border-radius: 0;
                max-width: 100%;
                transform: none; /* Remove transform on mobile */
            }
            .register-card:hover {
                transform: none;
                box-shadow: none;
            }
            .register-title {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>

<div class="register-section">
    <div class="left-side">
        <img src="{{ asset('foto/office.jpg') }}" alt="Register Illustration">
    </div>
    <div class="right-side">
        <div class="register-card">
            <div class="register-title">
                <i class="bi bi-person-plus-fill"></i>Buat Akun Baru
            </div>
            <p class="text-muted text-center mb-4">Login terlebih dahulu untuk masuk ke sistem!</p>

            <form action="{{ route('register.process') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Daftar Sekarang
                    </button>
                </div>

                <div class="text-center mt-4 text-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>