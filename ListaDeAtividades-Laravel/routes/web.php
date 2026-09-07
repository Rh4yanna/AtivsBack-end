<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ProfileController;
use App\Models\Curso;
use Illuminate\Support\Facades\Route;

// ATV 1: rotas simples. /alunos virou a listagem do CRUD nas atvs seguintes.
Route::get('/', fn () => view('home'));
Route::get('/sobre', fn () => 'Sobre o projeto Laravel');
Route::resource('alunos', AlunoController::class)->middleware('auth');
Route::get('/contato', fn () => 'Contato da escola');

// ATV 2: pega o id da URL e mostra no texto.
foreach (['produto', 'categoria', 'usuario'] as $recurso) {
    Route::get('/'.$recurso.'/{id}', fn (string $id) => ucfirst($recurso).': '.$id);
}

Route::get('/cursos/{curso}', fn (Curso $curso) => view('cursos.show', ['curso' => $curso->load('alunos')]))->middleware('auth')->name('cursos.show');

Route::get('/dashboard', fn () => view('dashboard'))->middleware('auth')->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

// ATV 21: precisa estar logado e ter o papel permitido pra acessar.
Route::view('/admin', 'admin')->middleware(['auth', 'role:admin'])->name('admin');
Route::view('/professor', 'professor')->middleware(['auth', 'role:admin,professor'])->name('professor');
