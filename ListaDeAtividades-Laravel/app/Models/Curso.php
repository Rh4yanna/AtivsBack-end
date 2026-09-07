<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    public function alunos(): HasMany
    {
        return $this->hasMany(Aluno::class);
    }

    protected $fillable = ['nome'];
}
