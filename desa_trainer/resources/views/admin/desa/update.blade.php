@extends('adminlte::page')

@section('title', 'Edición de Desa Trainer')

@section('content_header')
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check-circle-fill">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="exclamation-triangle-fill">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>

    <div class="w-100 d-flex">
        <h1 class="flex-grow-1">Edición de Desa Trainer</h1>
        <a href="{{ route('desa.index') }}" class="btn btn-primary" role="button">Volver</a>
    </div>
@stop

@section('content')
    <div class="w-100 h-100 bg-white d-flex flex-column align-items-center justify-content-center p-4 shadow-lg rounded">
        <form action="{{ route('desa.update', $desaTrainer->id) }}" method="POST" enctype="multipart/form-data"
            class="w-100 d-flex flex-column align-items-center justify-content-center">
            @csrf
            @method('PUT')

            <div class="mb-3 w-100">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control @if ($errors->any() && $errors->has('name')) is-invalid @elseif ($errors->any()) is-valid @endif"
                    name="name" id="name" value="{{ old('name', $desaTrainer->name) }}" required>
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
                        <div class="valid-feedback">¡Todo correcto!</div>
                    @endif
                @else
                    <small class="form-text text-muted">Introduce el nombre del Desa Trainer</small>
                @endif
            </div>

            <div class="mb-3 w-100">
                <label for="model" class="form-label">Modelo</label>
                <input type="text" class="form-control @if ($errors->any() && $errors->has('model')) is-invalid @elseif ($errors->any()) is-valid @endif"
                    name="model" id="model" value="{{ old('model', $desaTrainer->model) }}" required>
                @if ($errors->any())
                    @if ($errors->has('model'))
                        <div class="invalid-feedback">
                            <ul>
                                @foreach ($errors->get('model') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="valid-feedback">¡Todo correcto!</div>
                    @endif
                @else
                    <small class="form-text text-muted">Introduce el modelo del Desa Trainer</small>
                @endif
            </div>

            <div class="mb-3 w-100">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control @if ($errors->any() && $errors->has('description')) is-invalid @elseif ($errors->any()) is-valid @endif"
                    name="description" id="description" rows="3" required>{{ old('description', $desaTrainer->description) }}</textarea>
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
                        <div class="valid-feedback">¡Todo correcto!</div>
                    @endif
                @else
                    <small class="form-text text-muted">Introduce una descripción para el Desa Trainer</small>
                @endif
            </div>

            <div class="row justify-content-center align-items-center g-2 mb-3">
                <div class="col-md-4 text-center">
                    <label for="image" class="form-label">Imagen Actual</label>
                    <img src="{{ asset('storage/' . $desaTrainer->image) }}" class="img-fluid rounded mt-2" alt="Imagen Desa Trainer" style="max-width: 100%; height: auto;" />
                </div>
                <div class="col-md-8">
                    <label for="image" class="form-label">Subir nueva imagen</label>
                    <input type="file" class="form-control @if ($errors->has('image')) is-invalid @elseif($errors->any()) is-valid @endif" name="image" id="image" />
                    @if ($errors->has('image'))
                        <div class="invalid-feedback">
                            <ul>
                                @foreach ($errors->get('image') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif($errors->any())
                        <div class="valid-feedback">
                            ¡Todo correcto!
                        </div>
                    @else
                        <small class="form-text text-muted">Introduce una nueva imagen</small>
                    @endif
                </div>
            </div>

            <div class="d-grid gap-2 w-40">
                <button type="submit" class="btn btn-success">Actualizar DESA Trainer</button>
            </div>
        </form>
    </div>
@stop

@section('css')

@stop

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
                text: 'El formulario contiene algun error y no se puede modificar el dispositivo',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    });
</script>
@stop
