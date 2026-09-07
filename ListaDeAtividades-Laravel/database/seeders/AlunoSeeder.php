<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Database\Seeder;

class AlunoSeeder extends Seeder
{
    // ATV 12: cria 10 alunos e alterna entre os dois cursos.
    // Usa o e-mail pra não duplicar os alunos se rodar o seeder de novo.
    public function run(): void
    {
        foreach (['Ana Silva', 'Bruno Lima', 'Carla Souza', 'Daniel Alves', 'Elisa Santos', 'Felipe Costa', 'Gabriela Rocha', 'Hugo Martins', 'Isabela Dias', 'João Pereira'] as $i => $nome) {
            Aluno::updateOrCreate(['email' => 'aluno'.($i + 1).'@example.com'], ['nome' => $nome, 'curso_id' => Curso::firstOrCreate(['nome' => $i % 2 === 0 ? 'Informática' : 'Administração'])->id]);
        }
    }
}
