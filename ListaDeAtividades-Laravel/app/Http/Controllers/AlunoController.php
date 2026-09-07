<?php

namespace App\Http\Controllers;
use App\Models\Aluno;
use Illuminate\Http\Request;
class AlunoController extends Controller
{
    public function index(Request $request) {
        $query = Aluno::query();
        if ($request->filled('nome')) { $query->nomeContem($request->string('nome')->toString()); }
        if ($request->filled('curso')) { $query->doCurso($request->string('curso')->toString()); }
        if ($request->boolean('recentes')) { $query->recentes(); }
        return view('alunos.index', ['alunos' => $query->orderBy('nome')->paginate(10)->withQueryString(), 'total' => Aluno::count()]);
    }
    public function create() { return view('alunos.create'); }
    public function store(Request $request) {
        $data = $request->validate(['nome' => 'required|string|max:255', 'email' => 'required|email|unique:alunos,email', 'curso' => 'required|string|max:255']);
        $aluno = Aluno::create($data);
        return redirect()->route('alunos.show', $aluno)->with('success', 'Aluno cadastrado!');
    }
    public function show(Aluno $aluno) { return view('alunos.show', compact('aluno')); }
    public function edit(Aluno $aluno) { return view('alunos.edit', compact('aluno')); }
    public function update(Request $request, Aluno $aluno) {
        $data = $request->validate(['nome' => 'required|string|max:255', 'email' => ['required', 'email', \Illuminate\Validation\Rule::unique('alunos')->ignore($aluno)], 'curso' => 'required|string|max:255']);
        $aluno->update($data);
        return redirect()->route('alunos.show', $aluno)->with('success', 'Aluno atualizado!');
    }
    public function destroy(Aluno $aluno) { $aluno->delete(); return redirect()->route('alunos.index')->with('success', 'Aluno excluído!'); }
}
