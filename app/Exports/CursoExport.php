<?php

namespace App\Exports;

use App\Models\CursoModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Http\Controllers\CursoController;

class CursoExport implements FromCollection,WithHeadings
{

    public function headings():array{
        return [
            'Curso',
            'Total'
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
//        return CursoModel::all();

        return collect(CursoModel::SQLexcel());
    }
}
