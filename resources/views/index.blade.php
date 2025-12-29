<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIPASUR.SAC | Gestión Minera Responsable</title>
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('{{ asset('dist/img/fondo.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            color: white;
        }
        .navbar-custom {
            background: rgba(0, 0, 0, 0.8) !important;
        }
        .contact-info i { color: #ffc107; margin-right: 10px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="#">HIPASUR.SAC</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#empresa">Empresa</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item"><a href="{{ url('/admin') }}" class="btn btn-outline-warning ml-lg-3">Panel de Control</a></li>
                        @else
                            <li class="nav-item"><a href="{{ route('login') }}" class="btn btn-warning ml-lg-3 text-dark font-weight-bold">INICIAR SESIÓN</a></li>
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <header id="inicio" class="hero-section">
        <div class="container text-center text-lg-left">
            <h1 class="display-3 font-weight-bold" style="font-weight: 900; letter-spacing: 2px; text-shadow: 2px 2px 8px rgba(0,0,0,0.25); font-family: 'Segoe UI', 'Arial', sans-serif;">
                Extrayendo el <span class="text-warning" style="font-weight: 900; text-shadow: 2px 2px 8px #00000055;">Futuro</span>
            </h1>
            <p class="lead" style="font-weight: 600; letter-spacing: 1px;">Extraemos valor desde lo más profundo</p>
            <a href="#contacto" class="btn btn-warning btn-lg px-5">Contáctanos</a>
        </div>
    </header>

    <section id="empresa" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <i class="bi bi-shield-check display-4 text-primary"></i>
                    <h3>Seguridad</h3>
                    <p>Priorizamos la integridad de nuestro personal con estándares internacionales.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="bi bi-gear-wide-connected display-4 text-primary"></i>
                    <h3>Eficiencia</h3>
                    <p>Optimización de procesos mediante nuestro sistema de gestión avanzado.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="bi bi-geo-alt display-4 text-primary"></i>
                    <h3>Ubicación</h3>
                    <p> Puerto Punquiri Mza. e Lote. 11 - Madre de Dios, Perú</p>
                </div>
            </div>
        </div>
    </section>

    <footer id="contacto" class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>HIPASUR.SAC</h4>
                    <p>Innovación y compromiso minero.</p>
                    <div class="contact-info">
                        <p><i class="bi bi-clipboard-data-fill"></i> RUC: 20490566563</p>
                        <p><i class="bi bi-telephone-fill"></i> +51 986 886 909</p>
                        <p><i class="bi bi-envelope-at-fill"></i> contacto@hipasur.com.pe</p>
                        <p><i class="bi bi-geo-fill"></i>  Puerto Punquiri </p>
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <h5>Presentado por:</h5>
                    <p class="text-warning font-weight-bold">Nayeli Lizbeth Mena Ccori</p>
                    <p>&copy; 2025 Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>