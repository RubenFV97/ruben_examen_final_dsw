@extends('adminlte::page')
@section('title', 'Editar Transición')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Editar Transición</h1>
        <a class="btn btn-primary"
            href="{{ route('transitions.show', [$transition->fromInstruction->scenario->id, $transition->id]) }}">Volver</a>
    </div>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form
                    action="{{ route('transitions.update', [$transition->fromInstruction->scenario->id, $transition->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 d-flex flex-column">
                        <label for="from_instruction_id" class="form-label">De la instrucción</label>
                        <select
                            class="form-control form-select
                        @if ($errors->any()) @error('from_instruction_id')
                    is-invalid
                @enderror
                    is-valid @endif
                "
                            name="from_instruction_id" id="from_instruction_id">
                            <option value="">Selecciona una instrucción</option>
                            @foreach ($instructions as $instruction)
                                <option value="{{ $instruction->id }}"
                                    {{ $instruction->id == old('from_instruction_id', $transition->from_instruction_id) ? 'selected' : '' }}>
                                    {{ $instruction->name }}</option>
                            @endforeach
                        </select>
                        @error('from_instruction_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label for="to_instruction_id" class="form-label">A la instrucción</label>
                        <select
                            class="form-control form-select
                            @if ($errors->any()) @error('to_instruction_id')
                        is-invalid
                    @enderror
                        is-valid @endif
                            "
                            name="to_instruction_id" id="to_instruction_id">
                            <option value="">Selecciona una instrucción</option>
                            @foreach ($instructions as $instruction)
                                <option value="{{ $instruction->id }}"
                                    {{ $instruction->id == old('to_instruction_id', $transition->to_instruction_id) ? 'selected' : '' }}>
                                    {{ $instruction->name }}</option>
                            @endforeach
                        </select>
                        @error('to_instruction_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label for="trigger" class="form-label">Acción</label>
                        <select
                            class="form-control form-select
                            @if ($errors->any()) @error('trigger')
                        is-invalid
                    @enderror
                        is-valid @endif"
                            name="trigger" id="trigger">
                            <option value="">Selecciona una acción</option>
                            <option value="time" {{ old('trigger', $transition->trigger) == 'time' ? 'selected' : '' }}>
                                Tiempo</option>
                            <option value="user_choice"
                                {{ old('trigger', $transition->trigger) == 'user_choice' ? 'selected' : '' }}>Opción del
                                usuario</option>
                            <option value="loop" {{ old('trigger', $transition->trigger) == 'loop' ? 'selected' : '' }}>
                                Bucle</option>
                        </select>
                        @error('trigger')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 flex-column">
                        <label for="time_seconds" class="form-label">Opción:</label>
                        <input type="number"
                            class="form-control
                        @if ($errors->any()) @error('time_seconds')
                    is-invalid
                @enderror
                    is-valid @endif

                        "
                            name="time_seconds" id="time_seconds"
                            value="{{ old('time_seconds', $transition->time_seconds) }}">
                        @error('time_seconds')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 flex-column">
                        <label for="user_choice" class="form-label">Opción:</label>
                        <input type="text"
                            class="form-control
                        @if ($errors->any()) @error('user_choice')
                    is-invalid
                @enderror
                    is-valid @endif

                        "
                            name="user_choice" id="user_choice" value="{{ old('user_choice', $transition->user_choice) }}">
                        @error('user_choice')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 flex-column">
                        <label for="loop" class="form-label">Opción:</label>
                        <input type="text"
                            class="form-control
                        @if ($errors->any()) @error('loop_count')
                    is-invalid
                @enderror
                    is-valid @endif

                        "
                            name="loop_count" id="loop_count" value="{{ old('loop_count', $transition->loop_count) }}">
                        @error('loop_count')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#trigger').change(function() {
                if ($(this).val() == 'time') {
                    $('#time_seconds').parent().show();
                    $('#user_choice').parent().hide();
                    $('#loop_count').parent().hide();
                } else if ($(this).val() == 'user_choice') {
                    $('#time_seconds').parent().hide();
                    $('#user_choice').parent().show();
                    $('#loop_count').parent().hide();
                } else if ($(this).val() == 'loop') {
                    $('#time_seconds').parent().hide();
                    $('#user_choice').parent().hide();
                    $('#loop_count').parent().show();
                } else {
                    $('#time_seconds').parent().hide();
                    $('#user_choice').parent().hide();
                    $('#loop_count').parent().hide();
                }
            });
            $('#trigger').trigger('change');
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
                    text: 'El formulario contiene algun error y no se puede editar la transición',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        });
    </script>
@endsection
