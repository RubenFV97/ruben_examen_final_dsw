@extends('adminlte::page')

@section('title', 'Detalles del Usuario')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Detalles del Usuario</h1>
        <a href="{{ route('users.index') }}" class="btn btn-primary">Volver</a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nombre</th>
                    <td>{{ $usuario->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $usuario->email }}</td>
                </tr>
                <tr>
                    <th>Rol</th>
                    <td>{{ $usuario->rol }}</td>
                </tr>
            </table>
            <div class="mt-4 d-flex justify-content-end align-items-center">
                <a href="{{ route('users.edit', $usuario->id) }}" class="btn btn-warning text-white">Editar</a>

                <form action="{{ route('users.destroy', $usuario->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-user" style="margin-left: 10px;">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {

            // Manejo de eliminación con SweetAlert2
            $('.delete-user').click(function(e) {
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
