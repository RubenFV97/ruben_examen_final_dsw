@extends('adminlte::page')
@section('title', 'Detalles del Escenario')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Detalles del Escenario</h1>
        <a class="btn btn-primary" href="{{ route('scenarios.index') }}">Volver</a>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Nombre</th>
                        <td>{{ $scenario->name }}</td>
                    </tr>
                    <tr>
                        <th>Descripción corta</th>
                        <td>{{ $scenario->short_description }}</td>
                    </tr>
                    <tr>
                        <th>DesaTrainer</th>
                        <td>{{ $desatrainer->name }}</td>
                    </tr>
                    <tr>
                        <th>Imagen</th>
                        <td>{{ $desatrainer->image }}</td>
                    </tr>
                    <tr>
                        <th>Imagen</th>
                        <td>
                            @if ($desatrainer->image)
                                <img src="{{ asset('storage/' . $desatrainer->image) }}" alt="Imagen del DesaTrainer"
                                    style="max-width: 200px;">
                            @else
                                No disponible
                            @endif
                        </td>
                    </tr>

                    <th>Estado</th>
                        <td>
                            <!-- Formulario para actualizar el estado -->
                            <form action="{{ route('scenarios.updateStatus', $scenario->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="pendiente" {{ $scenario->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="en_proceso" {{ $scenario->status == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                        <option value="finalizado" {{ $scenario->status == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                                    </select>
                                </div>
                            </form>
                        </td>
                </table>
                <div class="mt-4 d-flex justify-content-end align-items-center">
                    <a href="{{ route('scenarios.edit', $scenario->id) }}" class="btn btn-warning text-white">Editar</a>

                    <form action="{{ route('scenarios.destroy', $scenario->id) }}" method="POST"
                        style="margin-left: 10px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-scenario">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
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
                            <th>Audio</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($instructions as $instruction)
                            <tr>
                                <td>{{ $instruction->name }}</td>
                                <td>{{ $instruction->action }}</td>
                                <td>
                                    @if ($instruction->audio)
                                        <audio controls>
                                            <source src="{{ asset('storage/' . $instruction->audio) }}" type="audio/mpeg">
                                            Tu navegador no soporta la reproducción de audio.
                                        </audio>
                                    @else
                                        No disponible
                                    @endif
                                </td>
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
                                        <button type="submit"
                                            class="btn btn-danger btn-sm delete-instruction">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Transiciones Asociadas</h3>
                    <a href="{{ route('transitions.create', $scenario->id) }}" class="btn btn-success text-white">
                        <i class="fas fa-plus"></i> Nueva Transicion
                    </a>
                </div>
                <table id="transitionsTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>De la instrucción</th>
                            <th>A la instrucción</th>
                            <th>Función</th>
                            <th>Acción</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transitions as $transition)
                            <tr>
                                <td>{{ $transition->id }}</td>
                                <td>{{ $transition->from_instruction_id }}</td>
                                <td>{{ $transition->to_instruction_id }}</td>
                                <td>{{ $transition->trigger }}</td>
                                <td>
                                    @switch($transition->trigger)
                                        @case('time')
                                            Tiempo
                                        @break

                                        @case('user_choice')
                                            Elección de Usuario
                                        @break

                                        @case('loop')
                                            Bucle
                                        @break

                                        @default
                                            {{ $transition->action }}
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('transitions.show', [$scenario->id, $transition->id]) }}"
                                        class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('transitions.edit', [$scenario->id, $transition->id]) }}"
                                        class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('transitions.destroy', [$scenario->id, $transition->id]) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-danger btn-sm delete-transition">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                    $(".dataTables_wrapper").addClass("bg-white shadow-lg rounded p-3 mb-3");
                }
            });
            $('#transitionsTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                },
                initComplete: function() {
                    // Añadir clases de Bootstrap a los elementos del contenedor de la tabla
                    $(".dataTables_wrapper").addClass("bg-white shadow-lg rounded p-3 mb-3");
                }
            });
        });
    </script>
    <script>
        $(function() {

            // Manejo de eliminación con SweetAlert2
            $('.delete-scenario').click(function(e) {
                e.preventDefault();
                const form = $(this).closest('form');

                Swal.fire({
                    title: '¿Estás seguro que quieres borrar el escenario?',
                    text: "¡No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            $('.delete-instruction').click(function(e) {
                e.preventDefault();
                const form = $(this).closest('form');

                Swal.fire({
                    title: '¿Estás seguro que quieres borrar la instrucción?',
                    text: "¡No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            $('.delete-transition').click(function(e) {
                e.preventDefault();
                const form = $(this).closest('form');

                Swal.fire({
                    title: '¿Estás seguro que quieres borrar la transición?',
                    text: "¡No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

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
        });
    </script>
@endsection
