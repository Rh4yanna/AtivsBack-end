<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlunoRequest;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AlunoController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Aluno::class);
        // Busca o curso junto pra evitar uma consulta extra por aluno.
        $query = Aluno::with('curso');
        // Aplica os filtros só quando forem preenchidos.
        if ($request->filled('nome')) {
            $query->nomeContem($request->string('nome')->toString());
        }
        if ($request->filled('curso')) {
            $query->doCurso($request->string('curso')->toString());
        }
        if ($request->boolean('recentes')) {
            $query->recentes();
        }

        // 10 por pág.; mantém os filtros ao trocar de página e mostra a qtd. total.
        return view('alunos.index', ['alunos' => $query->orderBy('nome')->paginate(10)->withQueryString(), 'total' => Aluno::count()]);
    }

    public function create()
    {
        Gate::authorize('create', Aluno::class);

        return view('alunos.create', ['cursos' => Curso::orderBy('nome')->get(), 'professores' => User::where('role', 'professor')->orderBy('name')->get()]);
    }

    public function store(AlunoRequest $request)
    {
        Gate::authorize('create', Aluno::class);
        // Salva só os dados que passaram pela validação do Request.
        $data = $request->validated();
        $aluno = Aluno::create($data);

        return redirect()->route('alunos.show', $aluno)->with('success', 'Aluno cadastrado!');
    }

    public function show(Aluno $aluno)
    {
        Gate::authorize('view', $aluno);

        return view('alunos.show', compact('aluno'));
    }

    public function edit(Aluno $aluno)
    {
        Gate::authorize('update', $aluno);

        return view('alunos.edit', ['aluno' => $aluno, 'cursos' => Curso::orderBy('nome')->get(), 'professores' => User::where('role', 'professor')->orderBy('name')->get()]);
    }

    public function update(AlunoRequest $request, Aluno $aluno)
    {
        Gate::authorize('update', $aluno);
        $data = $request->validated();
        $aluno->update($data);

        return redirect()->route('alunos.show', $aluno)->with('success', 'Aluno atualizado!');
    }

    public function destroy(Aluno $aluno)
    {
        Gate::authorize('delete', $aluno);
        $aluno->delete();

        return redirect()->route('alunos.index')->with('success', 'Aluno excluído!');
    }
}
