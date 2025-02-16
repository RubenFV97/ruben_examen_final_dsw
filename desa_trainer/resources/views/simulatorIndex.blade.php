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
            <a class="navbar-brand" href="index">
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
        <!-- Filtro por DESA Trainer -->
        <form method="GET" action="{{ route('dashboard') }}">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="desatrainer_id">Seleccionar DESA Trainer</label>
                    <select name="desatrainer_id" id="desatrainer_id" class="form-control">
                        <option value="">Todos los DESA Trainers</option>
                        @foreach($desas as $desa)
                            <option value="{{ $desa->id }}" {{ request('desatrainer_id') == $desa->id ? 'selected' : '' }}>
                                {{ $desa->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="search">Buscar Escenario</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Buscar por nombre"
                           value="{{ request('search') }}">
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary mt-4">Filtrar</button>
                </div>
            </div>
        </form>

        <!-- Listado de escenarios -->
        <div class="row">
            @foreach($scenarios as $scenario)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $scenario->image) }}" class="card-img-top" alt="{{ $scenario->desatrainer->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $scenario->name }}</h5>
                            <p class="card-text">Número de instrucciones: {{ $scenario->instructions_count }}</p>
                            <p class="card-text">DESA Trainer: {{ $scenario->desatrainer->name }}</p>
                            <a href="" class="btn btn-primary">
                                Iniciar Simulación
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
