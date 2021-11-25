<?php

namespace App\Http\Controllers;

use App\Models\CursoModel;
use Illuminate\Http\Request;
use Session;


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

    public function createCurso(Request $request){
        $nomeCurso = $request->nomeCurso;

        $curso = new CursoModel();

        $curso->nome = $nomeCurso;
        $curso->save();

        Session::put('mensagem', 'Curso salvo com sucesso!');
        return redirect('/');

    }


    public function deleteCurso($id) {

        $curso = CursoModel::find($id);
        $curso->ativo = false;
        $curso->save();

        Session::put('mensagem', 'Curso deletado com Sucesso!');
        return redirect('/');

    }

    public function updateCurso($id,$nome) {

        $curso = CursoModel::find($id);
        $curso->nome = false;
        $curso->save();

        Session::put('mensagem', 'Curso Atualziado com Sucesso!');
        return redirect('/');

    }



}
