@extends('adminlte::page')
@section('title', 'Creación de Usuario')
@section('content_header')


    <div class="w-100 d-flex">
        <h1 class="flex-grow-1">Creación de Usuario</h1>
        <a name="" id="" class="btn btn-primary" href="{{ route('users.index') }}" role="button">Volver</a>
    </div>
@endsection

@section('content')
    <div class="w-100 h-100 bg-white d-flex flex-column align-items-center justify-content-center p-4 shadow-lg rounded">
        <form action="{{ route('users.store') }}" method="post"
            class="w-100 d-flex flex-column align-items-center justify-content-center">
            @csrf
            <div class="mb-3 w-100">
                <label for="email" class="form-label">Email</label>
                <input type="email"
                    class="form-control
                @if ($errors->any()) @if ($errors->has('email'))
                    is-invalid
                @else
                    is-valid @endif
                @endif
                "
                    name="email" id="email" aria-describedby="emailHelp" placeholder="abc@mail.com"
                    value="{{ old('email') }}" required />
                @if ($errors->any())
                    @if ($errors->has('email'))
                        <div id="validationEmailFeedback" class="invalid-feedback">
                            <ul>
                                @foreach ($errors->get('email') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="valid-feedback">
                            ¡Todo correcto!
                        </div>
                    @endif
                @else
                    <small id="emailHelp" class="form-text text-muted">Introduce un email válido</small>
                @endif
            </div>
            <div class="mb-3 w-100">
                <label for="name" class="form-label">Nombre</label>
                <input type="text"
                    class="form-control
                @if ($errors->any()) @if ($errors->has('name'))
                    is-invalid
                @else
                    is-valid @endif
                @endif
                "
                    name="name" id="name" aria-describedby="nameHelp" placeholder="Nombre"
                    value="{{ old('name') }}" required />
                @if ($errors->any())
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            <ul>
                                @foreach ($errors->get('name') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="valid-feedback">
                            ¡Todo correcto!
                        </div>
                    @endif
                @else
                    <small id="nameHelp" class="form-text text-muted">Introduce un nombre</small>
                @endif
            </div>
            <div class="mb-3 w-100">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password"
                    class="form-control
                @if ($errors->any()) @if ($errors->has('password'))
                    is-invalid
                @else
                    is-valid @endif
                @endif"
                    name="password" id="password" placeholder="Introduce una contraseña" required />
                @if ($errors->any())
                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            <ul>
                                @foreach ($errors->get('password') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif
            </div>
            <div class="mb-3 w-100">
                <label for="password-confirm" class="form-label">Confirmación de Contraseña</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                    placeholder="Confirmar contraseña" required />
            </div>

            <div class="mb-3 w-100">
                <label for="role" class="form-label">Rol</label>
                <select class="form-select form-select" name="role" id="role">
                    <option selected>Selecciona un rol</option>
                    <option value="student">Alumno</option>
                    <option value="teacher">Profesor</option>
                    <option value="admin">Administrador</option>
                    <option value="admin">examen</option>
                </select>
            </div>

            <div class="d-grid gap-2 w-40">
                <button type="submit" name="btn" id="btn" class="btn btn-success text-white">
                    Crear Usuario
                </button>
            </div>
        </form>
    </div>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
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
                    text: 'El formulario contiene algun error y no se puede crear el usuario',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        });
    </script>
@endsection
