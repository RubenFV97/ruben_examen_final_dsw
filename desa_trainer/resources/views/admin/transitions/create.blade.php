@extends('adminlte::page')
@section('title', 'Crear Transición')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Creación de transiciones</h1>
        <a class="btn btn-primary" href="{{ route('scenarios.show', $scenario->id) }}">Volver</a>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('transitions.store', $scenario->id) }}" method="POST">
                    @csrf
                    <div class="mb-3 d-flex flex-column">
                        <label for="from_instruction_id" class="form-label">De la instrucción</label>
                        <select
                            class="form-control form-select
                        @if ($errors->has('from_instruction_id')) is-invalid @elseif($errors->any()) is-valid @endif"
                            name="from_instruction_id" id="from_instruction_id">
                            <option value="">Selecciona una instrucción</option>
                            @foreach ($instructions as $instruction)
                                <option value="{{ $instruction->id }}"
                                    {{ old('from_instruction_id') == $instruction->id ? 'selected' : '' }}>
                                    {{ $instruction->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('from_instruction_id'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('from_instruction_id') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label for="to_instruction_id" class="form-label">A la instrucción</label>
                        <select
                            class="form-control form-select
                        @if ($errors->has('to_instruction_id')) is-invalid @elseif($errors->any()) is-valid @endif"
                            name="to_instruction_id" id="to_instruction_id">
                            <option value="">Selecciona una instrucción</option>
                            @foreach ($instructions as $instruction)
                                <option value="{{ $instruction->id }}"
                                    {{ old('to_instruction_id') == $instruction->id ? 'selected' : '' }}>
                                    {{ $instruction->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('to_instruction_id'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('to_instruction_id') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="mb-3 d-flex flex-column">
                        <label for="trigger" class="form-label">Acción</label>
                        <select
                            class="form-control form-select
                        @if ($errors->has('trigger')) is-invalid @elseif($errors->any()) is-valid @endif"
                            name="trigger" id="trigger">
                            <option value="">Selecciona una acción</option>
                            <option value="time" {{ old('trigger') == 'time' ? 'selected' : '' }}>Tiempo</option>
                            <option value="user_choice" {{ old('trigger') == 'user_choice' ? 'selected' : '' }}>Elección de
                                Usuario</option>
                            <option value="loop" {{ old('trigger') == 'loop' ? 'selected' : '' }}>Bucle</option>
                        </select>
                        @if ($errors->has('trigger'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('trigger') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="mb-3 flex-column">
                        <label for="time_seconds" class="form-label">Segundos:</label>
                        <input type="number"
                            class="form-control
                        @if ($errors->has('time_seconds')) is-invalid @elseif($errors->any()) is-valid @endif"
                            name="time_seconds" id="time_seconds" placeholder="0" value="{{ old('time_seconds') }}" />
                        @if ($errors->has('time_seconds'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('time_seconds') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="mb-3 flex-column">
                        <label for="desa_button_id" class="form-label">Selecciona el botón</label>
                        <select
                            class="form-control form-select
                        @if ($errors->has('desa_button_id')) is-invalid @elseif($errors->any()) is-valid @endif"
                            name="desa_button_id" id="desa_button_id">
                            <option value="">Selecciona un botón</option>
                        </select>
                        @if ($errors->has('desa_button_id'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('desa_button_id') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="mb-3 flex-column">
                        <label for="loop_count" class="form-label">Cuantas veces se repite:</label>
                        <input type="number"
                            class="form-control
                        @if ($errors->has('loop_count')) is-invalid @elseif($errors->any()) is-valid @endif"
                            name="loop_count" id="loop_count" placeholder="0" value="{{ old('loop_count') }}" />
                        @if ($errors->has('loop_count'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('loop_count') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success">
                        Crear transición
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const triggerSelect = document.getElementById('trigger');
            const timeInput = document.getElementById('time_seconds').closest('.mb-3');
            const buttonSelect = document.getElementById('desa_button_id').closest('.mb-3');
            const loopCountInput = document.getElementById('loop_count').closest('.mb-3');

            function toggleFields() {
                const triggerValue = triggerSelect.value;
                timeInput.style.display = triggerValue === 'time' ? 'flex' : 'none';
                buttonSelect.style.display = triggerValue === 'user_choice' ? 'flex' : 'none';
                loopCountInput.style.display = triggerValue === 'loop' ? 'flex' : 'none';
            }

            triggerSelect.addEventListener('change', toggleFields);
            toggleFields();
        });
    </script>
    <script>
        $(function() {
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
                    text: 'El formulario contiene algún error y no se puede crear la transición',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        });
    </script>
@endsection
