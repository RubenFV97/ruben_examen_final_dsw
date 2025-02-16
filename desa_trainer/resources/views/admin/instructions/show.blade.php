@extends('adminlte::page')

@section('title', 'Detalles de la Instrucción')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Detalles de la Instrucción</h1>
        <a href="{{ route('scenarios.show', $instructions->scenario_id) }}" class="btn btn-primary">Volver</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nombre</th>
                    <td>{{ $instructions->name }}</td>
                </tr>
                <tr>
                    <th>Acción</th>
                    <td>{{ $instructions->action }}</td>
                </tr>
                <tr>
                    <th>Audio</th>
                    <td>
                        @if ($instructions->audio)
                            <audio controls>
                                <source src="{{ asset('storage/' . $instructions->audio) }}" type="audio/mpeg">
                                Tu navegador no soporta la reproducción de audio.
                            </audio>
                        @else
                            No disponible
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Descripción</th>
                    <td>{{ $instructions->description }}</td>
                </tr>
            </table>
            <div class="mt-4 d-flex justify-content-end align-items-center">
                <a href="{{ route('instructions.edit', $instructions->id) }}" class="btn btn-warning text-white">Editar</a>
                <form action="{{ route('instructions.destroy', $instructions->id) }}" method="POST"
                    style="margin-left: 10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta instrucción?')">Eliminar</button>
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
        });
    </script>
@endsection
