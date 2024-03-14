<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;

class Disciplina extends Model
{
    use HasFactory;
    protected $table = "disciplinas";
    protected $fillable = array("nome", "tipo", "etcs");

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'cursos_disciplinas')->withTimestamps();
    }
}
