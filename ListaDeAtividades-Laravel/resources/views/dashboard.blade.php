@extends('layouts.app')
@section('content')<h1>Painel da escola</h1><p>Olá, {{ auth()->user()->name }}. Seu papel é {{ auth()->user()->role }}.</p><a href="{{ route('alunos.index') }}">Consultar alunos</a>@if(auth()->user()->isAdmin())<p><a href="{{ route('admin') }}">Área administrativa</a></p>@endif<p><a href="{{ route('professor') }}">Área do professor</a></p>@endsection
