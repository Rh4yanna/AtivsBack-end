<?php

namespace App\Policies;

use App\Models\Aluno;
use App\Models\User;

class AlunoPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'professor'], true);
    }

    public function view(User $user, Aluno $aluno): bool
    {
        return $this->viewAny($user);
    }

    // ATV 23: só admin pode cadastrar.
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    // Admin edita todos; prof. só edita os alunos vinculados a ele.
    public function update(User $user, Aluno $aluno): bool
    {
        return $user->isAdmin() || ($user->role === 'professor' && $aluno->user_id === $user->id);
    }

    // Excluir tbm fica restrito ao admin.
    public function delete(User $user, Aluno $aluno): bool
    {
        return $user->isAdmin();
    }
}
