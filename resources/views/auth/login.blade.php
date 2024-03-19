<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
    }

    .bg-image {
      background-image: url('assets/bg-blue.jpg');
      background-size: cover;
      background-position: center;
    }
    .bg-blue {
      background-color: #f0f2f5;
    }

    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
    }

    .overlay {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      background: rgba(255, 255, 255, 0.5);
    }

    .info-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 0 3rem;
      width: 100%;
      text-align: left;
    }

    .form-signin {
      width: 100%;
      max-width: 400px;
      padding: 15px;
      margin-left: 200px;
    }
  </style>
</head>
<body>
  <div class="container-fluid g-0">
    <div class="row g-0">
      <div class="col-lg-6 bg-image position-relative d-none d-lg-block text-center">
        <div class="overlay"></div>
        <div class="info-content text-center">
            <h2 class="text-uppercase">{{ config('app.name') }}</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam iure praesentium numquam consequatur atque minima voluptatem fugit expedita ducimus deserunt ipsum quis iusto repellat, est voluptatum fuga labore dignissimos asperiores autem totam. Sed cumque alias saepe libero similique culpa harum impedit labore ducimus illo ea commodi exercitationem, fugiat nulla numquam.</p>
        </div>
      </div>
      <div class="col-lg-6 bg-blue">
        <div class="login-container">
          <form class="form-signin" action="{{ route('login.post') }}" autocomplete="off" method="post"> @csrf
            <h2 class="mb-3">Selamat Datang Admin</h2>
            <p class="mb-4">Silahkan masukkan email atau nomor telepon dan password Anda untuk mulai menggunakan aplikasi</p>
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Login!</strong> {{ Session::get("error") }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="mb-3">
                <label class="form-label">Email / Nomor Telpon</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Contoh: admin@gmail.com">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="Masukkan password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button class="btn btn-lg btn-primary w-100" type="submit">MASUK</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
