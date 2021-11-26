<?php

namespace App\Exports;

use App\Models\AlunoModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlunosExport implements FromCollection,WithHeadings
{

    public function headings():array{
        return [
            'Aluno ID',
            'Aluno Matricula',
            'Curso',
            'Aluno Nome',
            'CEP',
            'Cidade',
            'UF',
            'Logradouro',
            'Complemento',
            'Bairro',
        ];
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(AlunoModel::SQLexcel());
    }
}
