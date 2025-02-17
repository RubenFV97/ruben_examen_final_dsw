@extends('adminlte::page') 

@section('title', 'DESA Trainer') 

@section('content') 
<livewire:examencomponent :desaTrainer="$desaTrainer" /> 
@endsection