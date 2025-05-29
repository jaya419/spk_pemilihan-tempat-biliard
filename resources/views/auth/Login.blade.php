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
       /* Latar belakang biliar terpusat dan menutupi seluruh halaman */
       background: url('foto/billiard.jpg') no-repeat center center fixed; 
       background-size: cover; 
       display: flex; 
       align-items: center; /* Memusatkan secara vertikal */
       justify-content: center; /* Memusatkan secara horizontal */
     } 

     .overlay { 
       position: absolute; 
       top: 0; left: 0; 
       width: 100%; 
       height: 100%; 
       background-color: rgba(0, 0, 0, 0.4); /* Overlay untuk kontras teks */
       z-index: 1; 
     } 

     .login-card { 
       position: relative; 
       z-index: 2; /* Pastikan kartu di atas overlay */
       background-color: rgba(255, 255, 255, 0.95); /* Sedikit transparan untuk efek modern */
       padding: 3rem; 
       border-radius: 1.5rem; 
       box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25); 
       width: 100%; 
       max-width: 450px; 
       transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; 
     } 

     .login-card:hover { 
       transform: translateY(-5px); 
       box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3); 
     } 

     .form-control { 
       border-radius: 0.75rem; 
       padding: 0.75rem 1rem; 
       border: 1px solid #ced4da; 
     } 

     .form-control:focus { 
       box-shadow: 0 0 0 0.25rem rgba(74, 144, 226, 0.25); 
       border-color: #4a90e2; 
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
     } 

     .text-link a:hover { 
       color: #357ABD; 
       text-decoration: underline; 
     } 

     .alert { 
       border-radius: 0.75rem; 
       font-size: 0.9rem; 
       padding: 0.75rem 1.25rem; 
     } 

     @media (max-width: 576px) { 
       .login-card { 
         padding: 2rem; 
         border-radius: 1rem; 
         box-shadow: none; 
       } 
     } 
   </style> 
 </head> 
 <body> 

   <div class="overlay"></div> 

   <div class="login-card"> 
     <h3 class="mb-3 text-center fw-bold" style="color: #4a90e2;">Selamat Datang Kembali!</h3> 
     <p class="text-muted text-center mb-4">Silakan login terlebih dahulu untuk masuk ke sistem.</p> 

     @if (session('status')) 
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

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> 
 </body> 
 </html>