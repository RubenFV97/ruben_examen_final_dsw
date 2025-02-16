
@extends('adminlte::page')
@section('title', 'Admin Dashboard')
@section('content_header')
  <h1>Admin Dashboard</h1>
@endsection
@section('content')
  <p>Bienvenido al panel de administración.</p>
@endsection
<!--
Primero, se utiliza la directiva `extends` para indicar que esta plantilla hereda de otra plantilla llamada `adminlte::page`. Esto significa que la plantilla base `adminlte::page` proporciona una estructura general y estilos que esta plantilla específica reutiliza.


La directiva `section('title', 'Admin Dashboard')` define el contenido de la sección `title` de la plantilla base. En este caso, establece el título de la página como "Admin Dashboard".


Luego, se define la sección `content_header` con la directiva `section('content_header')`. Dentro de esta sección, se incluye un encabezado de nivel 1 (`<h1>`) con el texto "Admin Dashboard". Esta sección se utiliza para mostrar el encabezado de la página en el panel de administración.


A continuación, se define la sección `content` con la directiva `section('content')`. Dentro de esta sección, se incluye un párrafo (`<p>`) con el texto "Bienvenido al panel de administración". Esta sección se utiliza para mostrar el contenido principal de la página.


Este archivo Blade define una vista para el panel de administración que hereda de una plantilla base, establece el título de la página, muestra un encabezado y un mensaje de bienvenida en el contenido principal.


El fichero que contiene la plantilla adminlte::page se encuentra dentro del paquete jeroennoten/laravel-adminlte. Específicamente, puedes encontrarlo en el siguiente directorio dentro de tu proyecto Laravel: vendor/jeroennoten/laravel-adminlte/resources/views/page.blade.php


Este archivo page.blade.php es la plantilla base proporcionada por el paquete AdminLTE que define la estructura general y los estilos que se reutilizan en las vistas que extienden de esta plantilla.
-->

