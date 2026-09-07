<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Curso extends Model { public function alunos(): \Illuminate\Database\Eloquent\Relations\HasMany { return $this->hasMany(Aluno::class); } protected $fillable = ['nome']; }

