<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home'));
Route::get('/sobre', fn () => 'Sobre o projeto Laravel');
Route::resource('alunos', \App\Http\Controllers\AlunoController::class);
Route::get('/contato', fn () => 'Contato da escola');

foreach (['produto', 'categoria', 'usuario'] as $recurso) {
    Route::get('/'.$recurso.'/{id}', fn (string $id) => ucfirst($recurso).': '.$id);
}

Route::get('/cursos/{curso}', fn (\App\Models\Curso $curso) => view('cursos.show', ['curso' => $curso->load('alunos')]))->name('cursos.show');
