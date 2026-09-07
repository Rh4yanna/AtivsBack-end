@extends('layouts.app')
@section('content')
<h1>{{ $aluno->nome }}</h1>
<p>{{ $aluno->email }}</p>
<p>Curso: {{ $aluno->curso?->nome ?? 'Sem curso' }}</p>
<p>Professor responsável: {{ $aluno->user?->name ?? 'Sem responsável' }}</p>
@if($aluno->curso)
    <p><a href="{{ route('cursos.show', $aluno->curso) }}">Ver todos os alunos deste curso</a></p>
@endif
@can('update', $aluno)
    <a href="{{ route('alunos.edit', $aluno) }}">Editar</a>
@endcan
@can('delete', $aluno)<form method="POST" action="{{ route('alunos.destroy', $aluno) }}">@csrf @method('DELETE')<button>Excluir aluno</button></form>@endcan
@endsection
