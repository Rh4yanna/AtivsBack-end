<?php

namespace Database\Seeders;
use App\Models\Aluno;
use Illuminate\Database\Seeder;
class AlunoSeeder extends Seeder {
    public function run(): void {
        foreach (['Ana Silva','Bruno Lima','Carla Souza','Daniel Alves','Elisa Santos','Felipe Costa','Gabriela Rocha','Hugo Martins','Isabela Dias','João Pereira'] as $i => $nome) {
            Aluno::updateOrCreate(['email' => 'aluno'.($i + 1).'@example.com'], ['nome' => $nome, 'curso' => $i % 2 === 0 ? 'Informática' : 'Administração']);
        }
    }
}
