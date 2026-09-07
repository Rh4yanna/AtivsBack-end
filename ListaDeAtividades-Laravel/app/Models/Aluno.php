<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aluno extends Model
{
    use HasFactory;

    // user_id guarda o prof. responsável pelo aluno.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

    // ATV 11: filtra pelo nome do curso relacionado.
    public function scopeDoCurso($query, string $curso)
    {
        return $query->whereHas('curso', fn ($q) => $q->where('nome', $curso));
    }

    // Os % permitem buscar só uma parte do nome.
    public function scopeNomeContem($query, string $palavra)
    {
        return $query->where('nome', 'like', '%'.$palavra.'%');
    }

    // Aqui, cad. recente = feito nos últimos 30 dias.
    public function scopeRecentes($query)
    {
        return $query->where('created_at', '>=', now()->subDays(30));
    }

    protected $fillable = ['nome', 'email', 'curso_id', 'user_id'];
}
