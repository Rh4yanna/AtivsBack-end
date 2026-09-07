<?php

use Illuminate\Support\Facades\Artisan;
use App\Models\Aluno;
Artisan::command('alunos:consultar {curso?} {palavra?}', function () {
    $this->info('Quantidade de alunos: '.Aluno::count());
    $this->info('Recentes (30 dias): '.Aluno::recentes()->count());
    $this->line(Aluno::doCurso($this->argument('curso') ?? 'Informática')->get()->toJson(JSON_UNESCAPED_UNICODE));
    $this->line(Aluno::nomeContem($this->argument('palavra') ?? 'Ana')->get()->toJson(JSON_UNESCAPED_UNICODE));
})->purpose('Demonstrar as quatro consultas Eloquent');
