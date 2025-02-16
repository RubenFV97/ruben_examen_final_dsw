@extends('adminlte::page')
@section('title', 'Escenarios')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Escenarios</h1>
        <a href="{{ route('scenarios.create') }}" class="btn btn-success text-white">
            <i class="fas fa-plus"></i> Nuevo Escenario
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="scenariosTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>DesaTrainer</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scenarios as $scenario)
                        <tr>
                            <td class="align-middle">{{ $scenario->name }}</td>
                            <td class="align-middle">{{ $scenario->short_description }}</td>
                            <td class="align-middle">
                                @if ($scenario->image)
                                    <img src="{{ asset('storage/' . $scenario->image) }}" alt="Imagen"
                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                @else
                                    <span>No disponible</span>
                                @endif
                            </td>
                            <td class="align-middle">{{ $scenario->desatrainer->name }}</td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-around">
                                    <a href="{{ route('scenarios.show', $scenario->id) }}" class="text-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('scenarios.edit', $scenario->id) }}" class="text-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('scenarios.destroy', $scenario->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn text-danger p-0 border-0 mx-2 delete-scenario">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#scenariosTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
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
                    title: '¿Estás seguro?',
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
@stop
