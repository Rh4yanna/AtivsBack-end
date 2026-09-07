@extends('layouts.app')
@section('content')<h1>Alunos de {{ $curso->nome }}</h1>@if($curso->alunos->isEmpty())<p>Nenhum aluno neste curso.</p>@endif<ul>@foreach($curso->alunos as $aluno)<li><a href="{{ route('alunos.show', $aluno) }}">{{ $aluno->nome }}</a></li>@endforeach</ul>@endsection
