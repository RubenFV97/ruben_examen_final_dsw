@extends('adminlte::page')

@section('title', 'DESA Trainers')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>DESA Trainers</h1>
        <a href="{{ route('desa.create') }}" class="btn btn-success text-white">
            <i class="fas fa-plus"></i> Nuevo DESA Trainer
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="desaTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Modelo</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $dato)
                        <tr>
                            <td>{{ $dato->name }}</td>
                            <td>{{ $dato->model }}</td>
                            <td>{{ $dato->description }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $dato->image) }}" alt="Imagen de {{ $dato->name }}"
                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="{{ route('desa.show', $dato->id) }}" class="text-primary" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('desa.edit', $dato->id) }}" class="text-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('desa.editButtons', $dato->id) }}" class="text-success" title="Editar Botones">
                                        <i class="fas fa-toggle-on"></i>
                                    </a>

                                    <form action="{{ route('desa.destroy', $dato->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn text-danger p-0 border-0 delete-trainer">
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
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#desaTable').DataTable({
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
            $('.delete-trainer').click(function(e) {
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
@endsection
