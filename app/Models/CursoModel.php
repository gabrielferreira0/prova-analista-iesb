<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoModel extends Model
{
    use HasFactory;


    protected $table = 'cursos';

    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'ativo',
    ];

}
