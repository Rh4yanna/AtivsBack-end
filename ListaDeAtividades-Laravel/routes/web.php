<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home'));
Route::get('/sobre', fn () => 'Sobre o projeto Laravel');
Route::resource('alunos', \App\Http\Controllers\AlunoController::class)->middleware('auth');
Route::get('/contato', fn () => 'Contato da escola');

foreach (['produto', 'categoria', 'usuario'] as $recurso) {
    Route::get('/'.$recurso.'/{id}', fn (string $id) => ucfirst($recurso).': '.$id);
}

Route::get('/cursos/{curso}', fn (\App\Models\Curso $curso) => view('cursos.show', ['curso' => $curso->load('alunos')]))->middleware('auth')->name('cursos.show');

Route::get('/dashboard', fn () => view('dashboard'))->middleware('auth')->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

Route::view('/admin', 'admin')->middleware(['auth','role:admin'])->name('admin');
Route::view('/professor', 'professor')->middleware(['auth','role:admin,professor'])->name('professor');
