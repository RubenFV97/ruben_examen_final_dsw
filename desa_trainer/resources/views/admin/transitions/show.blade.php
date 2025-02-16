@extends('adminlte::page')
@section('title', 'Transición')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Transición</h1>
        <a class="btn btn-primary" href="{{ route('scenarios.show', $transition->fromInstruction->scenario->id) }}">Volver</a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>De la instrucción:</th>
                    <td>{{ $transition->from_instruction_id }} @foreach ($instructions as $instruction)
                            @if ($instruction->id == $transition->from_instruction_id)
                                {{ $instruction->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>A la instrucción:</th>
                    <td>{{ $transition->to_instruction_id }} @foreach ($instructions as $instruction)
                            @if ($instruction->id == $transition->to_instruction_id)
                                {{ $instruction->name }}
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Acción</th>
                    <td>
                        @switch($transition->trigger)
                            @case('time')
                                Tiempo
                            @break

                            @case('user_choice')
                                Opción del usuario
                            @break

                            @case('loop')
                                Bucle
                            @break

                            @default
                        @endswitch
                    </td>
                </tr>
                <tr>
                    <th>Opción:</th>
                    <td>
                        @switch($transition->trigger)
                            @case('time')
                                {{ $transition->time_seconds }} s
                            @break

                            @case('user_choice')
                                {{ $transition->user_choice }}
                            @break

                            @case('loop')
                                {{ $transition->loop_count }}
                            @break

                            @default
                        @endswitch
                    </td>
                </tr>
            </table>
            <div class="mt-4 d-flex justify-content-end align-items-center">
                <a href="{{ route('transitions.edit', [$transition->fromInstruction->scenario->id, $transition->id]) }}"
                    class="btn btn-warning text-white">Editar</a>
                <form
                    action="{{ route('transitions.destroy', [$transition->fromInstruction->scenario->id, $transition->id]) }}"
                    method="POST" style="margin-left: 10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-transition">Eliminar</button>
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

            // Manejo de eliminación con SweetAlert2
            $('.delete-transition').click(function(e) {
                e.preventDefault();
                const form = $(this).closest('form');

                Swal.fire({
                    title: '¿Estás seguro que quieres eliminar la transición?',
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
        });
    </script>
@endsection
