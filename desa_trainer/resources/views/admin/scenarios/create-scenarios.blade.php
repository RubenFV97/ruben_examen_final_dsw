@extends('adminlte::page')
@section('title', 'Creación de Escenario')
@section('content_header')


    <div class="w-100 d-flex">
        <h1 class="flex-grow-1">Creación de Escenario</h1>
        <a name="" id="" class="btn btn-primary" href="{{ route('scenarios.index') }}" role="button">Volver</a>
    </div>
@stop
@section('content')
    <div class="w-100 h-100 bg-white d-flex flex-column align-items-center justify-content-center p-4 shadow-lg rounded">

        <form action="{{ route('scenarios.store') }}" method="post"
            class="w-100 d-flex flex-column align-items-center justify-content-center" enctype="multipart/form-data">
            @csrf

            <div class="mb-3 w-100">
                <label for="name" class="form-label">Nombre</label>
                <input type="text"
                    class="form-control
                    @if ($errors->any()) @if ($errors->has('name'))
                        is-invalid
                    @else
                        is-valid @endif
                    @endif"
                    name="name" id="name" placeholder="Nombre" value="{{ old('name') }}" />
                @if ($errors->any())
                    @if ($errors->has('name'))
                        <div id="validationNameFeedback" class="invalid-feedback">
                            <ul>
                                @foreach ($errors->get('name') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="valid-feedback">
                            ¡Todo correcto!
                        </div>
                    @endif
                @else
                    <small id="helpName" class="form-text text-muted">Introduce el nombre del escenario</small>
                @endif
            </div>

            <div class="mb-3 w-100">
                <label for="short_description" class="form-label">Descripción corta</label>
                <input type="text"
                    class="form-control
                    @if ($errors->any()) @if ($errors->has('short_description'))
                        is-invalid
                    @else
                        is-valid @endif
                    @endif"
                    name="short_description" id="short_description" placeholder="Descripción corta"
                    value="{{ old('short_description') }}" />
                @if ($errors->any())
                    @if ($errors->has('short_description'))
                        <div id="validationShortDescriptionFeedback" class="invalid-feedback">
                            <ul>
                                @foreach ($errors->get('short_description') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="valid-feedback">
                            ¡Todo correcto!
                        </div>
                    @endif
                @else
                    <small id="helpShortDesc" class="form-text text-muted">Introduce una descripción corta</small>
                @endif
            </div>

            <div class="mb-3 w-100">
                <label for="long_description" class="form-label">Descripción larga</label>
                <textarea
                    class="form-control
                    @if ($errors->any()) @if ($errors->has('long_description'))
                        is-invalid
                    @else
                        is-valid @endif
                    @endif"
                    name="long_description" id="long_description" rows="3" placeholder="Descripción Larga">{{ old('long_description') }}</textarea>
                @if ($errors->any())
                    @if ($errors->has('long_description'))
                        <div id="validationLongDescriptionFeedback" class="invalid-feedback">
                            <ul>
                                @foreach ($errors->get('long_description') as $error)
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
                    <small id="helpLongDesc" class="form-text text-muted">Introduce una descripción larga</small>
                @endif
            </div>

            <div class="mb-3 w-100">
                <label for="image" class="form-label">Imagen</label>
                <input type="file"
                    class="form-control
                    @if ($errors->any()) @if ($errors->has('image'))
                        is-invalid
                    @else
                        is-valid @endif
                    @endif"
                    name="image" id="image" placeholder="Imagen" />
                @if ($errors->any())
                    @if ($errors->has('image'))
                        <div id="validationImageFeedback" class="invalid-feedback">
                            <ul>
                                @foreach ($errors->get('image') as $error)
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
                    <div id="helpImage" class="form-text">Introduce una imagen del escenario</div>
                @endif
            </div>

            <div class="mb-3 w-100">
                <label for="desatrainer_id" class="form-label">Desa trainer</label>
                <select
                    class="form-select
                    @if ($errors->any()) @if ($errors->has('desatrainer_id'))
                        is-invalid
                    @else
                        is-valid @endif
                    @endif"
                    name="desatrainer_id" id="desatrainer_id">
                    @foreach ($desas as $desa)
                        <option value="{{ $desa->id }}" @if (old('desatrainer_id') == $desa->id) selected @endif>
                            {{ $desa->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->any())
                    @if ($errors->has('desatrainer_id'))
                        <div id="validationDesatrainerFeedback" class="invalid-feedback">
                            <ul>
                                @foreach ($errors->get('desatrainer_id') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="valid-feedback">
                            ¡Todo correcto!
                        </div>
                    @endif
                @endif
            </div>

            <div class="d-grid gap-2 w-40">
                <button type="submit" name="btnCreate" id="btnCreate" class="btn btn-success">
                    Crear Escenario
                </button>
            </div>
        </form>
    </div>
@stop
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
@stop
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
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
                    text: 'El formulario contiene algun error y no se puede crear el escenario',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        });
    </script>
@stop
