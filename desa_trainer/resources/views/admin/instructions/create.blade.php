@extends('adminlte::page')

@section('title', 'Creación de Instrucción')

@section('content_header')
    <div class="w-100 d-flex">
        <h1 class="flex-grow-1">Creación de Instrucción</h1>
        <a name="" id="" class="btn btn-primary" href="{{ route('scenarios.show', $scenario->id) }}"
            role="button">Volver</a>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <!-- Formulario de creación de instrucción -->
                <form action="{{ route('instructions.store', $scenario->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text"
                                    class="form-control
                                    @if ($errors->any()) @if ($errors->has('name'))
                                        is-invalid
                                    @else
                                        is-valid @endif
                                    @endif
                                        "
                                    name="name" id="name" aria-describedby="nameHelp" placeholder="Nombre"
                                    value="{{ old('name') }}" required />
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
                                <label for="action">Acción</label>
                                <input type="text"
                                    class="form-control
                                @if ($errors->any()) @if ($errors->has('action'))
                                    is-invalid
                                @else
                                    is-valid @endif
                                @endif
                                "
                                    name="action" id="action" aria-describedby="actionHelp" placeholder="Acción"
                                    value="{{ old('action') }}" required />
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

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="audio" class="form-label">Audio</label>
                                <input type="file" id="audio" name="audio" class="form-control @error('audio') is-invalid @enderror" accept="audio/*">
                                @error('audio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea
                                        class="form-control
                                    @if ($errors->any()) @if ($errors->has('description'))
                                        is-invalid
                                    @else
                                        is-valid @endif
                                    @endif
                                    "
                                        id="description" name="description" rows="4" placeholder="Descripción" aria-describedby="descHelp" required>{{ old('description') }}</textarea>
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

                    <!-- Campo para seleccionar el botón necesario para avanzar -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desa_buttons_id" class="form-label">Botón necesario para avanzar</label>
                                <select name="desa_buttons_id" id="desa_buttons_id" class="form-control @error('desa_buttons_id') is-invalid @enderror">
                                    <option value="">Selecciona un botón</option>
                                    @foreach($desaButtons as $button)
                                        <option value="{{ $button->id }}" {{ old('desa_buttons_id') == $button->id ? 'selected' : '' }}>
                                            {{ $button->label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('desa_buttons_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success">Crear Instrucción</button>
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
                    text: 'El formulario contiene algun error y no se puede crear la instrucción',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        });
    </script>
@endsection
