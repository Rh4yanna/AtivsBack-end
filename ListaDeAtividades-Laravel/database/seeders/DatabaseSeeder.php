<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Aluno;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder {
    public function run(): void {
        foreach (['admin' => 'Administrador', 'professor' => 'Professor'] as $role => $nome) {
            $user = User::firstOrNew(['email' => $role.'@example.com']);
            $user->name = $nome; $user->password = Hash::make('Laravel@123'); $user->role = $role; $user->save();
        }
        $this->call(AlunoSeeder::class);
        Aluno::whereIn('email', array_map(fn ($n) => 'aluno'.$n.'@example.com', range(1,10)))->update(['user_id' => User::where('email', 'professor@example.com')->firstOrFail()->id]);
    }
}
