<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Aluno extends Model
{
    use HasFactory;
    public function curso(): \Illuminate\Database\Eloquent\Relations\BelongsTo { return $this->belongsTo(Curso::class); }
    public function scopeDoCurso($query, string $curso) { return $query->whereHas('curso', fn ($q) => $q->where('nome', $curso)); }
    public function scopeNomeContem($query, string $palavra) { return $query->where('nome', 'like', '%'.$palavra.'%'); }
    public function scopeRecentes($query) { return $query->where('created_at', '>=', now()->subDays(30)); }
    protected $fillable = ['nome', 'email', 'curso_id'];
}
