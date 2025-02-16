@extends('adminlte::page')

@section('title', 'Edición de Instrucción')

@section('content_header')
    <div class="w-100 d-flex">
        <h1 class="flex-grow-1">Edición de Instrucción</h1>
        <a href="{{ route('scenarios.show', $datos->scenario_id) }}" class="btn btn-primary">Volver</a>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('instructions.update', $datos->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text"
                                    class="form-control
                                @if ($errors->any()) @if ($errors->has('name'))
                                    is-invalid
                                @else
                                    is-valid @endif
                                @endif
                                "
                                    id="name" name="name" aria-describedby="nameHelp" placeholder="Nombre"
                                    value="{{ old('name', $datos->name) }}" required>
                                @if ($errors->any())
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            <ul>
                                                @foreach ($errors->get('name') as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <div class="valid-feedback">
                                            Todo correcto!
                                        </div>
                                    @endif
                                @else
                                    <small id="nameHelp" class="form-text text-muted">Introduce un nombre</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="action" class="form-label">Acción</label>
                                <input type="text"
                                    class="form-control
                                @if ($errors->any()) @if ($errors->has('action'))
                                    is-invalid
                                @else
                                    is-valid @endif
                                @endif
                                "
                                    id="action" name="action" aria-describedby="actionHelp" placeholder="Acción"
                                    value="{{ old('action', $datos->action) }}" required>
                                @if ($errors->any())
                                    @if ($errors->has('action'))
                                        <div class="invalid-feedback">
                                            <ul>
                                                @foreach ($errors->get('action') as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <div class="valid-feedback">
                                            Todo correcto!
                                        </div>
                                    @endif
                                @else
                                    <small id="actionHelp" class="form-text text-muted">Introduce la acción a
                                        realizar</small>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="audio" class="form-label">Audio</label>
                                <input type="file"
                                    class="form-control
                                @if ($errors->any()) @if ($errors->has('audio'))
                                    is-invalid
                                @else
                                    is-valid @endif
                                @endif
                                "
                                    id="audio" name="audio" aria-describedby="audioHelp" accept="audio/*">
                                @if ($errors->any())
                                    @if ($errors->has('audio'))
                                        <div class="invalid-feedback">
                                            <ul>
                                                @foreach ($errors->get('audio') as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <div class="valid-feedback">
                                            Todo correcto!
                                        </div>
                                    @endif
                                @else
                                    <small id="actionHelp" class="form-text text-muted">Introduce un audio para la
                                        instrucción</small>
                                @endif
                                @if ($datos->audio)
                                    <div class="mt-2">
                                        <p>Audio actual: <a href="{{ asset('storage/' . $datos->audio) }}"
                                                target="_blank">Reproducir</a></p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea id="description"
                        class="form-control
                    @if ($errors->any()) @if ($errors->has('description'))
                        is-invalid
                    @else
                        is-valid @endif
                    @endif
                    "
                        id="description" name="description" rows="4" placeholder="Descripción" aria-describedby="descHelp" required>{{ old('description', $datos->description) }}</textarea>
                    @if ($errors->any())
                        @if ($errors->has('description'))
                            <div class="invalid-feedback">
                                <ul>
                                    @foreach ($errors->get('description') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <div class="valid-feedback">
                                Todo correcto!
                            </div>
                        @endif
                    @else
                        <small id="descHelp" class="form-text text-muted">Introduce una descripción para la
                            instrucción</small>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Actualizar Instrucción</button>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script>
        $(function() {

            // Mostrar mensaje de éxito/error
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'El formulario contiene algun error y no se puede modificar la instrucción',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        });
    </script>
@endsection
