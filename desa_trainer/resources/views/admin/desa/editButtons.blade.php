<!-- filepath: /c:/xampp/htdocs/desa_trainer_grupo_3/desa_trainer/resources/views/admin/desa/editButtons.blade.php -->
@extends('adminlte::page')
@section('title', 'Editar Botones')
@section('content_header')

@stop
@section('content')
    <livewire:desa-trainer-show :desaTrainer="$desaTrainer" />
@endsection
@section('js')
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
        });
    </script>
@endsection
