<?php

namespace App\Http\Controllers;

use App\Models\CursoModel;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {

        $cursos = $this->getAllCursos();


        return view('cursos', compact('cursos'));
    }


    public function getAllCursos()
    {
            $cursos = CursoModel::where('ativo', true)->orderBy('nome','ASC')->get();
//            $cursos = CursoModel::all();
        return $cursos;
    }


}
