<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnderecoModel extends Model
{
    use HasFactory;


    protected $table = 'endereco_aluno';

    protected $primaryKey = 'ender_id';
    public $timestamps = false;

    protected $fillable = [
        'aluno_id',
        'ender_CEP',
        'ender_cidade',
        'ender_UF',
        'ender_logradouro',
        'ender_complemento',
        'ender_bairro',
    ];

    public function aluno()
    {
        return $this->belongsTo(AlunoModel::class);
    }
}
