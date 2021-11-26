<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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


    public function SQLexcel()
    {

        $relatorio = DB::table('cursos')
            ->select('nome',)
            ->selectRaw('count(1) as total')
            ->join('alunos', 'cursos.id', '=', 'alunos.aluno_curso')
            ->where('alunos.aluno_ativo', true)
            ->where('cursos.ativo', true)
            ->groupBy('cursos.nome')
            ->get()
            ->toarray();

        return $relatorio;
    }

}
