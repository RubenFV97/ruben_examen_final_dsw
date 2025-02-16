<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .navbar {
            background: linear-gradient(to right, #2c3e50, #4ca1af);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link {
            font-size: 1.2rem;
            padding: 10px 20px;
            transition: all 0.3s ease-in-out;
        }
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }
        .dropdown-menu {
            min-width: 200px;
        }
        .dropdown-item {
            font-size: 1.1rem;
        }
        .container h1 {
            color: #2c3e50;
            font-weight: bold;
        }
        .container p {
            font-size: 1.1rem;
        }
        .container ul li {
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-heartbeat fa-2x text-danger"></i>
                DESA Trainer
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-4">
                        <a class="nav-link" href="{{ route('simulator.index') }}"><i class="fas fa-play-circle"></i> Simulación</a> 
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-user"></i> Panel de Control</a>
                    </li>

                    @auth
                    <!-- Menú desplegable con el nombre del usuario autenticado -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container text-center mt-5">
        <h1 class="mb-3">Bienvenido a la Aplicación</h1>
        <br>
        <div class="text-start mt-4">
            <h2>¿Qué es un DESA Trainer?</h2>
            <p>Un <strong>DESA Trainer</strong> es un dispositivo de entrenamiento diseñado para simular el funcionamiento de un <strong>Desfibrilador Externo Semiautomático (DESA)</strong>. Su objetivo principal es formar a personas en la correcta utilización de un desfibrilador en situaciones de emergencia por paro cardíaco.</p>
            <h3>Características Principales</h3>
            <ul>
                <li><strong>Simulación realista</strong>: Permite practicar en entornos controlados sin administrar descargas eléctricas reales.</li>
                <li><strong>Modos de entrenamiento</strong>: Algunos modelos incluyen distintos escenarios para mejorar la preparación del usuario.</li>
                <li><strong>Indicaciones visuales y auditivas</strong>: Guía a los aprendices mediante instrucciones claras y secuenciales.</li>
                <li><strong>Electrodos reutilizables</strong>: Se pueden colocar y retirar varias veces sin perder efectividad.</li>
                <li><strong>Control remoto (en algunos modelos)</strong>: Permite al instructor modificar el entrenamiento en tiempo real.</li>
            </ul>
            <h3>Importancia del Entrenamiento con DESA Trainer</h3>
            <p>El uso correcto de un desfibrilador puede aumentar considerablemente las probabilidades de supervivencia de una persona en paro cardíaco. La capacitación con un <strong>DESA Trainer</strong> es esencial para:</p>
            <ul>
                <li>Reducir la ansiedad en situaciones de emergencia.</li>
                <li>Mejorar la rapidez y eficacia de la respuesta.</li>
                <li>Familiarizarse con el proceso de desfibrilación.</li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
