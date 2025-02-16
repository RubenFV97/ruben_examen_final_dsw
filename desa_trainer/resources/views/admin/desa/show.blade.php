@extends('adminlte::page')

@section('title', 'Detalles del DESA')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Detalles del DESA</h1>
        <a href="{{ route('desa.index') }}" class="btn btn-primary">Volver</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nombre</th>
                    <td>{{ $datos->name }}</td>
                </tr>
                <tr>
                    <th>Modelo</th>
                    <td>{{ $datos->model }}</td>
                </tr>
                <tr>
                    <th>Descripción</th>
                    <td>{{ $datos->description }}</td>
                </tr>
                <tr>
                    <th>Imagen</th>
                    <td>
                        <img src="{{ asset('storage/' . $datos->image) }}" alt="Imagen de {{ $datos->name }}"
                            style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                    </td>
                </tr>
            </table>
            <div class="mt-4 d-flex justify-content-end align-items-center">
                <a href="{{ route('desa.edit', $datos->id) }}" class="btn btn-warning text-white">Editar</a>
                <form action="{{ route('desa.destroy', $datos->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="margin-left: 10px;"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este DESA?')">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
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
        });
    </script>
@endsection
