@extends('layouts.app')
@section('content')<h1>Cadastrar aluno</h1><form method="POST" action="{{ route('alunos.store') }}">@include('alunos._form')</form>@endsection
