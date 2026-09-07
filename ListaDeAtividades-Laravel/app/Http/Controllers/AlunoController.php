<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class AlunoController extends Controller
{
    public function index() { return 'Lista de alunos'; }
    public function create() { return 'Cadastrar aluno'; }
    public function store(Request $request) { return 'Salvar aluno'; }
    public function show(string $aluno) { return 'Aluno '.$aluno; }
    public function edit(string $aluno) { return 'Editar aluno '.$aluno; }
    public function update(Request $request, string $aluno) { return 'Atualizar aluno '.$aluno; }
    public function destroy(string $aluno) { return 'Excluir aluno '.$aluno; }
}
