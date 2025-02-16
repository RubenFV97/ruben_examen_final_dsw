@extends('adminlte::page')
@section('title', 'Edición de Escenario')
@section('content_header')
    <div class="w-100 d-flex">
        <h1 class="flex-grow-1">Edición de Escenario</h1>
        <a name="" id="" class="btn btn-primary" href="{{ route('scenarios.index') }}" role="button">Volver</a>
    </div>
@endsection
@section('content')
    <div
        class="w-100 h-100 bg-white d-flex flex-column align-items-center justify-content-center p-4 shadow-lg rounded mb-4">
        <form action="{{ route('scenarios.update', $scenario->id) }}" method="post"
            class="w-100 d-flex flex-column align-items-center justify-content-center" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3 w-100">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" value="{{ $scenario->name }}"
                    class="form-control @if ($errors->has('name')) is-invalid @elseif($errors->any()) is-valid @endif"
                    name="name" id="name" placeholder="Nombre" />
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        <ul>
                            @foreach ($errors->get('name') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif($errors->any())
                    <div class="valid-feedback">
                        Todo correcto!
                    </div>
                @else
                    <small class="form-text text-muted">Introduce el nombre del escenario</small>
                @endif
            </div>

            <div class="mb-3 w-100">
                <label for="short_description" class="form-label">Descripción corta</label>
                <input type="text" value="{{ $scenario->short_description }}"
                    class="form-control @if ($errors->has('short_description')) is-invalid @elseif($errors->any()) is-valid @endif"
                    name="short_description" id="short_description" placeholder="Descripción corta" />
                @if ($errors->has('short_description'))
                    <div class="invalid-feedback">
                        <ul>
                            @foreach ($errors->get('short_description') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif($errors->any())
                    <div class="valid-feedback">
                        Todo correcto!
                    </div>
                @else
                    <small class="form-text text-muted">Introduce una descripción corta</small>
                @endif
            </div>

            <div class="mb-3 w-100">
                <label for="long_description" class="form-label">Descripción larga</label>
                <textarea
                    class="form-control @if ($errors->has('long_description')) is-invalid @elseif($errors->any()) is-valid @endif"
                    name="long_description" id="long_description" rows="3" placeholder="Descripción Larga">{{ $scenario->long_description }}</textarea>
                @if ($errors->has('long_description'))
                    <div class="invalid-feedback">
                        <ul>
                            @foreach ($errors->get('long_description') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif($errors->any())
                    <div class="valid-feedback">
                        Todo correcto!
                    </div>
                @else
                    <small class="form-text text-muted">Introduce una descripción larga</small>
                @endif
            </div>

            <div class="mb-3 w-100">
                <label for="desatrainer_id" class="form-label">Desa trainer</label>
                <select
                    class="form-select @if ($errors->has('desatrainer_id')) is-invalid @elseif($errors->any()) is-valid @endif"
                    name="desatrainer_id" id="desatrainer_id">
                    @foreach ($desas as $desa)
                        <option value="{{ $desa->id }}" @if ($scenario->desatrainer_id == $desa->id) selected @endif>
                            {{ $desa->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('desatrainer_id'))
                    <div class="invalid-feedback">
                        <ul>
                            @foreach ($errors->get('desatrainer_id') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif($errors->any())
                    <div class="valid-feedback">
                        Todo correcto!
                    </div>
                @endif
            </div>

            <div class="row justify-content-center align-items-center g-2 mb-3">
                <div class="col-md-4 text-center">
                    <label for="image" class="form-label">Imagen Actual</label>
                    <img src="{{ asset('storage/' . $scenario->image) }}" class="img-fluid rounded mt-2"
                        alt="Imagen escenario actual" style="max-width: 100%; height: auto;" />
                </div>
                <div class="col-md-8">
                    <label for="image" class="form-label">Subir nueva imagen</label>
                    <input type="file"
                        class="form-control @if ($errors->has('image')) is-invalid @elseif($errors->any()) is-valid @endif"
                        name="image" id="image" />
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
                            Todo correcto!
                        </div>
                    @else
                        <small class="form-text text-muted">Introduce una nueva imagen</small>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="status">Estado</label>
                <select name="status" id="status" class="form-control">
                    <option value="pendiente" {{ old('status', $scenario->status) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="en_proceso" {{ old('status', $scenario->status) == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                    <option value="finalizado" {{ old('status', $scenario->status) == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                </select>
            </div>

            <div class="d-grid gap-2 w-100 text-center">
                <button type="submit" class="btn btn-success text-white">
                    Actualizar Escenario
                </button>
            </div>
        </form>

    </div>

    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Instrucciones Asociadas</h3>
                <a href="{{ route('instructions.create', $scenario->id) }}" class="btn btn-success text-white">
                    <i class="fas fa-plus"></i> Nueva Instrucción
                </a>
            </div>
            <table id="instructionsTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acción</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scenario->instructions as $instruction)
                        <tr>
                            <td>{{ $instruction->name }}</td>
                            <td>{{ $instruction->action }}</td>
                            <td>{{ $instruction->description }}</td>
                            <td>
                                <a href="{{ route('instructions.show', $instruction->id) }}"
                                    class="btn btn-info btn-sm">Ver</a>

                                <a href="{{ route('instructions.edit', $instruction->id) }}"
                                    class="btn btn-warning btn-sm">Editar</a>

                                <form action="{{ route('instructions.destroy', $instruction->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Está seguro de eliminar esta instrucción?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
            <div class="row">
                <div class="col-12">
                    <div class="mt-4">
                        @livewire('admin.instruction-transitions', ['scenario' => $scenario])
                    </div>
                </div>
            </div>
@endsection

@section('css')
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha384-jLKHWMzzFZqJhsCUb9ZzUJ6j60RkAo3vQbOJ4S9A4vwx8dd6M/hHB1yF5Rnn3Khi" crossorigin="anonymous">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#instructionsTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                },
                initComplete: function() {
                    // Añadir clases de Bootstrap a los elementos del contenedor de la tabla
                    $(".dataTables_wrapper").addClass("bg-white shadow-lg rounded p-3");
                }
            });
        });
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
                    text: 'El formulario contiene algun error y no se puede modificar el escenario',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        });
    </script>
@endsection
