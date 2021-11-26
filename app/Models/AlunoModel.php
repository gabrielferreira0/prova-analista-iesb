<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AlunoModel extends Model
{
    use HasFactory;

    protected $table = 'alunos';

    protected $primaryKey = 'aluno_id';
    public $timestamps = false;

    protected $fillable = [
        'aluno_matricula',
        'aluno_nome',
        'aluno_curso',
        'aluno_ativo'
    ];


    public function enderecos()
    {
        return $this->hasOne(EnderecoModel::class, 'aluno_id');
    }

    public function SQLexcel()
    {

        $relatorio = DB::table('alunos')
            ->select('alunos.aluno_id','alunos.aluno_matricula','cursos.nome',
                     'alunos.aluno_nome', 'ender_CEP','ender_cidade','ender_UF','ender_logradouro',
                'ender_complemento','ender_bairro')
            ->join('cursos', 'alunos.aluno_curso', '=', 'cursos.id')
            ->join('endereco_aluno', 'alunos.aluno_id', '=', 'endereco_aluno.aluno_id')
            ->where('alunos.aluno_ativo', true)
            ->where('cursos.ativo', true)
            ->get()
            ->toarray();


        return $relatorio;
    }


}
