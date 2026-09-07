<?php

namespace App\Http\Controllers;
use App\Models\Aluno;
use App\Http\Requests\AlunoRequest;
use Illuminate\Http\Request;
class AlunoController extends Controller
{
    public function index(Request $request) {
        $query = Aluno::with('curso');
        if ($request->filled('nome')) { $query->nomeContem($request->string('nome')->toString()); }
        if ($request->filled('curso')) { $query->doCurso($request->string('curso')->toString()); }
        if ($request->boolean('recentes')) { $query->recentes(); }
        return view('alunos.index', ['alunos' => $query->orderBy('nome')->paginate(10)->withQueryString(), 'total' => Aluno::count()]);
    }
    public function create() { return view('alunos.create', ['cursos' => \App\Models\Curso::orderBy('nome')->get()]); }
    public function store(AlunoRequest $request) {
        $data = $request->validated();
        $aluno = Aluno::create($data);
        return redirect()->route('alunos.show', $aluno)->with('success', 'Aluno cadastrado!');
    }
    public function show(Aluno $aluno) { return view('alunos.show', compact('aluno')); }
    public function edit(Aluno $aluno) { return view('alunos.edit', ['aluno' => $aluno, 'cursos' => \App\Models\Curso::orderBy('nome')->get()]); }
    public function update(AlunoRequest $request, Aluno $aluno) {
        $data = $request->validated();
        $aluno->update($data);
        return redirect()->route('alunos.show', $aluno)->with('success', 'Aluno atualizado!');
    }
    public function destroy(Aluno $aluno) { $aluno->delete(); return redirect()->route('alunos.index')->with('success', 'Aluno excluído!'); }
}
