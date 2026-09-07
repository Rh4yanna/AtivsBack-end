<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));
Route::get('/sobre', fn () => 'Sobre o projeto Laravel');
Route::get('/alunos', fn () => 'Lista de alunos');
Route::get('/contato', fn () => 'Contato da escola');

foreach (['produto', 'categoria', 'usuario'] as $recurso) {
    Route::get('/'.$recurso.'/{id}', fn (string $id) => ucfirst($recurso).': '.$id);
}
