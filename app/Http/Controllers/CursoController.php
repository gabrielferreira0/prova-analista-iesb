<?php

namespace App\Http\Controllers;

use App\Exports\CursoExport;
use App\Models\CursoModel;
use Illuminate\Http\Request;
use Session;
use Maatwebsite\Excel\Facades\Excel;


class CursoController extends Controller
{
    public function index()
    {

        $cursos = $this->getAllCursos();

        return view('cursos', compact('cursos'));
    }


    public function getAllCursos()
    {
        $cursos = CursoModel::where('ativo', true)->orderBy('nome', 'ASC')->get();
//            $cursos = CursoModel::all();
        return $cursos;
    }

    public function createOrUpdateCurso(Request $request)
    {
        $nomeCurso = $request->nomeCurso;
        $idCurso = $request->idcurso;

//firstOrNew  Verifica se já possui registro no banco para inserir ou atualizar

        $curso = CursoModel::firstOrNew(
            ['id' => $idCurso]
        );

        $curso->nome = $nomeCurso;
        $curso->save();

        Session::put('mensagem', 'Operação realizada com sucesso!');
        return redirect('/');

    }


    public function deleteCurso($id)
    {

        $curso = CursoModel::find($id);
        $curso->ativo = false;
        $curso->save();

        Session::put('mensagem', 'Curso deletado com Sucesso!');
        return redirect('/');

    }

    public function updateCurso($id, $nome)
    {

        $curso = CursoModel::find($id);
        $curso->nome = false;
        $curso->save();

        Session::put('mensagem', 'Curso Atualziado com Sucesso!');
        return redirect('/');

    }

    public function export()
    {
        return Excel::download(new CursoExport, 'relatorioCursos.xlsx');
    }







}
