<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('custom-css')
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/vascomm-logo.png') }}" alt="vascomm logo" width="150" height="30">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <form class="d-flex flex-grow-1 mx-5">
                    <div class="input-group">
                        <input type="text" placeholder="Cari parfum kesukaanmu" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                          </svg></span>
                    </div>
                </form>
                <div>
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">MASUK</a>
                    <a href="#" class="btn btn-primary">DAFTAR</a>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')

    <div class="border-top mt-5">
        <div class="container">
            <footer class="py-5">
                <div class="row">
                    <div class="col-4 text-center">
                        <img src="{{ asset('assets/vascomm-logo.png') }}" width="250" height="50">
                        <p class="mt-4 mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, voluptatem.</p>
                        <div class="d-flex justify-content-center py-5">
                            <ul class="list-unstyled d-flex">
                              <li class="ms-3"><a class="link-dark text-primary" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                              </svg></a></li>
                              <li class="ms-3"><a class="link-dark text-primary"" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15"/>
                              </svg></a></li>
                              <li class="ms-3"><a class="link-dark text-primary"" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                              </svg></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-2">
                        <h5>Layanan</h5>
                        <ul class="nav flex-column mt-4">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">BANTUAN</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">TANYA JAWAB</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">HUBUNGI KAMI</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">CARA BERJUALAN</a></li>
                        </ul>
                    </div>
            
                    <div class="col-2">
                        <h5>Tentang Kami</h5>
                        <ul class="nav flex-column mt-4">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">ABOUT US</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">KARIR</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">BLOG</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">KEBIJAKAN PRIVASI</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">SYARAT DAN <br> KETENTUAN</a></li>
                        </ul>
                    </div>
            
                    <div class="col-2">
                        <h5>Mitra</h5>
                        <ul class="nav flex-column mt-4">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">SUPPLIER</a></li>
                        </ul>
                    </div>
                </div>               
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>