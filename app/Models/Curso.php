<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Disciplina;

class Curso extends Model
{
    use HasFactory;
    protected $table = "cursos";
    protected $fillable = array("nome", "anos", "coordenador", "tipo");

    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class, 'cursos_disciplinas')->withTimestamps();
    }
}
