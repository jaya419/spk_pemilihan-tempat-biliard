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
            font-family: 'Poppins', sans-serif;
            /* Latar belakang yang sama dengan halaman login (gambar biliar) */
            background: url('foto/billiard.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex; /* Untuk memusatkan konten secara vertikal dan horizontal */
            align-items: center;
            justify-content: center;
        }

        .overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4); /* Overlay untuk kontras teks */
            z-index: 1;
        }

        /* Mengganti .register-card agar sesuai dengan .login-card */
        .register-card {
            position: relative; /* Penting agar di atas overlay */
            z-index: 2;
            background-color: rgba(255, 255, 255, 0.95); /* Sedikit transparan */
            padding: 3rem;
            border-radius: 1.5rem;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 450px; /* Lebar maksimal disamakan dengan login card */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .register-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }

        .register-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #4a90e2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-title i {
            font-size: 2.2rem;
            margin-right: 0.75rem;
        }

        .form-label {
            font-weight: 500;
            color: #343a40;
        }

        .form-control {
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .form-control:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 0.25rem rgba(74, 144, 226, 0.25);
        }

        .btn-primary {
            background-color: #4a90e2;
            border: none;
            border-radius: 0.75rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: background-color 0.2s ease-in-out, transform 0.1s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #357ABD;
            transform: translateY(-2px);
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
            color: #6c757d !important;
            font-size: 0.95rem;
        }

        /* Media queries untuk responsivitas disesuaikan */
        @media (max-width: 576px) { /* Mengubah breakpoint dari 768px ke 576px agar sesuai dengan login card */
            .register-card {
                padding: 2rem;
                border-radius: 1rem;
                box-shadow: none;
                transform: none;
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

<div class="overlay"></div>

<div class="register-card">
    <div class="register-title">
        <i class="bi bi-person-plus-fill"></i>Buat Akun Baru
    </div>
    <p class="text-muted text-center mb-4">Silakan daftar untuk membuat akun baru.</p>

    <form action="{{ route('register.process') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" required>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>