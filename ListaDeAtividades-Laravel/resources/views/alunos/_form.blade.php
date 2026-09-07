@csrf
<label>Nome <input name="nome" value="{{ old('nome', $aluno->nome ?? '') }}" required maxlength="255"></label>@error('nome')<p class="error">{{ $message }}</p>@enderror
<label>E-mail <input type="email" name="email" value="{{ old('email', $aluno->email ?? '') }}" required maxlength="255"></label>@error('email')<p class="error">{{ $message }}</p>@enderror
<label>Curso <input name="curso" value="{{ old('curso', $aluno->curso ?? '') }}" required maxlength="255"></label>
<button type="submit">Salvar aluno</button><a href="{{ route('alunos.index') }}">Cancelar</a>
