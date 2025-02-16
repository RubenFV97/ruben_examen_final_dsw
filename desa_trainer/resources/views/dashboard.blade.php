
@section('title', 'Lista de Simulaciones')
@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Detalles del Escenario</h1>
        <a class="btn btn-primary" href="{{ route('index') }}">Volver</a>
    </div>
@endsection

@section('content')
    <h1>Simulador de Escenarios</h1>
    <div class="container">

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
                            <!-- Cambiar por las simulaciones -->
                        <a href="" class="btn btn-primary">
                            Iniciar Simulación
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
