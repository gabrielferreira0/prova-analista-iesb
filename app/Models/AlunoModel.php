<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
