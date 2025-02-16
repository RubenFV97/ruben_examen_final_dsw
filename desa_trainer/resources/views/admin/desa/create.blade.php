@extends('adminlte::page')

@section('title', 'Creación de Desa Trainer')
@section('content_header')


    <div class="w-100 d-flex">
        <h1 class="flex-grow-1">Creación de Desa Trainer</h1>
        <a name="" id="" class="btn btn-primary" href="{{ route('desa.index') }}" role="button">Volver</a>
    </div>
@stop

@section('content')
    <div class="w-100 h-100 bg-white d-flex flex-column align-items-center justify-content-center p-4 shadow-lg rounded">
        <form action="{{ route('desa.store') }}" method="post" class="w-100 d-flex flex-column align-items-center justify-content-center" enctype="multipart/form-data">
            @csrf

            <div class="mb-3 w-100">
                <label for="name" class="form-label">Nombre</label>
                <input type="text"
                    class="form-control @if ($errors->any() && $errors->has('name')) is-invalid @elseif ($errors->any()) is-valid @endif"
                    name="name" id="name" placeholder="Nombre del Desa Trainer" value="{{ old('name') }}" required>
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
                        <div class="valid-feedback">Todo correcto!</div>
                    @endif
                @else
                    <small class="form-text text-muted">Introduce el nombre del Desa Trainer</small>
                @endif
            </div>

            <div class="mb-3 w-100">
                <label for="model" class="form-label">Modelo</label>
                <input type="text"
                    class="form-control @if ($errors->any() && $errors->has('model')) is-invalid @elseif ($errors->any()) is-valid @endif"
                    name="model" id="model" placeholder="Modelo del Desa Trainer" value="{{ old('model') }}" required>
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
                    name="description" id="description" rows="3" placeholder="Descripción del Desa Trainer">{{ old('description') }}</textarea>
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

            <div class="mb-3 w-100">
                <label for="image" class="form-label">Imagen</label>
                <input type="file"
                    class="form-control @if ($errors->any() && $errors->has('image')) is-invalid @elseif ($errors->any()) is-valid @endif"
                    name="image" id="image" required>
                @if ($errors->any())
                    @if ($errors->has('image'))
                        <div class="invalid-feedback">
                            <ul>
                                @foreach ($errors->get('image') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="valid-feedback">¡Todo correcto!</div>
                    @endif
                @else
                    <small class="form-text text-muted">Sube una imagen para el Desa Trainer</small>
                @endif
            </div>

            <div class="d-grid gap-2 w-40">
                <button type="submit" class="btn btn-success">Crear DESA Trainer</button>
            </div>
        </form>
    </div>
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
                text: 'El formulario contiene algun error y no se puede crear el dispositivo',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    });
</script>
@stop
