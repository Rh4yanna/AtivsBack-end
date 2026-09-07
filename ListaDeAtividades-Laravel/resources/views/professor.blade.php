@extends('layouts.app')
@section('content')<h1>Área de professor</h1><p>Bem-vindo, {{ auth()->user()->name }}.</p><a href="{{ route('alunos.index') }}">Gerenciar alunos</a>@endsection
