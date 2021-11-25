<?php

namespace App\Http\Controllers;
use App\Models\AlunoModel;
use App\Models\EnderecoModel;
use Illuminate\Http\Request;
use DB;
use Session;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = $this->getAllAlunos();
        $cursoController =  New CursoController;
        $cursos = $cursoController->getAllCursos();
        return view('alunos', compact('alunos','cursos'));
    }

    public function getAllAlunos(){
        $alunos = DB::table('alunos')
            ->where('aluno_ativo', true)
            ->join('endereco_aluno', 'alunos.aluno_id', '=', 'endereco_aluno.aluno_id')
            ->join('cursos', 'alunos.aluno_curso', '=', 'cursos.id')
            ->orderBy('nome', 'ASC')->get();
        return $alunos;
    }


    public function createOrUpdateAluno(Request $request) {
        $aluno_id = $request->idaluno;
        $request->ender_CEP = preg_replace('/[^0-9]/', '', $request->ender_CEP);

        $aluno = AlunoModel::firstOrNew(
            ['aluno_id' => $aluno_id]
        );

        $aluno->aluno_nome = $request->aluno_nome;
        $aluno->aluno_matricula = $request->aluno_matricula;
        $aluno->aluno_curso = $request->aluno_curso;
        $aluno->save();

        $aluno_id = $aluno['aluno_id'];

        $endereco = EnderecoModel::firstOrNew(
            ['aluno_id' => $aluno_id]
        );



        $endereco->aluno_id = $aluno_id;
        $endereco->ender_CEP = $request->ender_CEP;
        $endereco->ender_cidade = $request->ender_cidade;
        $endereco->ender_UF = $request->ender_UF;
        $endereco->ender_logradouro = $request->ender_logradouro;
        $endereco->ender_complemento = $request->ender_complemento;
        $endereco->ender_bairro = $request->ender_bairro;
        $endereco->save();

        Session::put('mensagem', 'Operação realizada com sucesso!');
        return redirect('/alunos');

    }


    public function deleteAluno($id)
    {

        $AlunoModel = AlunoModel::find($id);
        $AlunoModel->aluno_ativo = false;
        $AlunoModel->save();

        Session::put('mensagem', 'Aluno deletado com Sucesso!');
        return redirect('/alunos');

    }


}
