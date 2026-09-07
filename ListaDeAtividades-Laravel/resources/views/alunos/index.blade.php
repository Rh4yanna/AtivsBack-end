@extends('layouts.app')
@section('content')
<h1>Alunos</h1><p>Total de alunos: {{ $total }}</p><a href="{{ route('alunos.create') }}">Cadastrar aluno</a>
<form method="GET" action="{{ route('alunos.index') }}"><label>Nome <input name="nome" value="{{ request('nome') }}"></label><label>Curso <input name="curso" value="{{ request('curso') }}"></label><label><input type="checkbox" name="recentes" value="1" @checked(request('recentes'))> Cadastrados nos últimos 30 dias</label><button>Filtrar</button><a href="{{ route('alunos.index') }}">Limpar</a></form>
@if($alunos->isEmpty())<p>Nenhum aluno encontrado.</p>@endif
<table><thead><tr><th>Nome</th><th>E-mail</th><th>Curso</th></tr></thead><tbody>@foreach($alunos as $aluno)<tr><td><a href="{{ route('alunos.show', $aluno) }}">{{ $aluno->nome }}</a></td><td>{{ $aluno->email }}</td><td>{{ $aluno->curso }}</td></tr>@endforeach</tbody></table>
{{ $alunos->links() }}
@endsection
