@csrf
<label>Nome <input name="nome" value="{{ old('nome', $aluno->nome ?? '') }}" required maxlength="255"></label>@error('nome')<p class="error">{{ $message }}</p>@enderror
<label>E-mail <input type="email" name="email" value="{{ old('email', $aluno->email ?? '') }}" required maxlength="255"></label>@error('email')<p class="error">{{ $message }}</p>@enderror
<label>Curso <select name="curso_id" required><option value="">Selecione</option>@foreach($cursos as $curso)<option value="{{ $curso->id }}" @selected(old('curso_id', $aluno->curso_id ?? '') == $curso->id)>{{ $curso->nome }}</option>@endforeach</select></label>@error('curso_id')<p class="error">{{ $message }}</p>@enderror
@if(auth()->user()->isAdmin())<label>Professor responsável <select name="user_id"><option value="">Sem responsável</option>@foreach($professores as $professor)<option value="{{ $professor->id }}" @selected(old('user_id', $aluno->user_id ?? '') == $professor->id)>{{ $professor->name }}</option>@endforeach</select></label>@endif
<button type="submit">Salvar aluno</button><a href="{{ route('alunos.index') }}">Cancelar</a>
