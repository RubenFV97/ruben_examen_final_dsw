@extends('adminlte::page')

@section('title', 'Edición de Usuario')

@section('content_header')
    <div class="w-100 d-flex">
        <h1 class="flex-grow-1">Edición de Usuario</h1>
        <a name="" id="" class="btn btn-primary" href="{{ route('users.index') }}" role="button">Volver</a>
    </div>
@endsection

@section('content')
    <div class="w-100 h-100 bg-white d-flex flex-column align-items-center justify-content-center p-4 shadow-lg rounded">
        @if ($errors->any())
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show w-100" role="alert">
                <svg class="bi me-2" style="height: 16px; width: 16px" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div class="flex-grow-1">
                    ¡Hay algún error!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show w-100" role="alert">
                <svg class="bi flex-shrink-0 me-2" style="height: 16px; width: 16px" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div class="flex-grow-1">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('users.update', $usuario->id) }}" method="post" class="w-100 d-flex flex-column align-items-center justify-content-center">
            @csrf
            @method('PUT') 
            
            <div class="mb-3 w-100">
                <label for="email" class="form-label">Email</label>
                <input type="email" 
                    class="form-control @if ($errors->any()) @if ($errors->has('email')) is-invalid @else is-valid @endif @endif"
                    name="email" id="email" placeholder="abc@mail.com" value="{{ old('email', $usuario->email) }}" required />

                @if ($errors->any() && $errors->has('email'))
                    <div class="invalid-feedback">
                        @foreach ($errors->get('email') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @elseif (!$errors->any())
                    <small id="emailHelp" class="form-text text-muted">Introduce un email válido</small>
                @endif
            </div>

            <div class="mb-3 w-100">
                <label for="name" class="form-label">Nombre</label>
                <input type="text"
                    class="form-control @if ($errors->any()) @if ($errors->has('name')) is-invalid @else is-valid @endif @endif"
                    name="name" id="name" placeholder="Nombre" value="{{ old('name', $usuario->name) }}" required />

                @if ($errors->any() && $errors->has('name'))
                    <div class="invalid-feedback">
                        @foreach ($errors->get('name') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @elseif (!$errors->any())
                    <small id="nameHelp" class="form-text text-muted">Introduce un nombre</small>
                @endif
            </div>

            <div class="mb-3 w-100">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password"
                    class="form-control @if ($errors->any()) @if ($errors->has('password')) is-invalid @else is-valid @endif @endif"
                    name="password" id="password" placeholder="Introduce una contraseña" />

                @if ($errors->any() && $errors->has('password'))
                    <div class="invalid-feedback">
                        @foreach ($errors->get('password') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="mb-3 w-100">
                <label for="password-confirm" class="form-label">Confirmación de Contraseña</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                    placeholder="Confirmar contraseña" />
            </div>

            <div class="mb-3 w-100">
                <label for="role" class="form-label">Rol</label>
                <select class="form-select form-select @if ($errors->any()) @if ($errors->has('role')) is-invalid @else is-valid @endif @endif" 
                        name="role" id="role" required>
                    <option value="student" {{ old('role', $usuario->role) == 'student' ? 'selected' : '' }}>Alumno</option>
                    <option value="teacher" {{ old('role', $usuario->role) == 'teacher' ? 'selected' : '' }}>Profesor</option>
                    <option value="admin" {{ old('role', $usuario->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                </select>
                @if ($errors->any() && $errors->has('role'))
                    <div class="invalid-feedback">
                        @foreach ($errors->get('role') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="d-grid gap-2 w-40">
                <button type="submit" class="btn btn-success text-white">
                    Actualizar Usuario
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
                    text: 'El formulario contiene algun error y no se puede modificar el usuario',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        });
    </script>
@endsection
