<?php

namespace App\Http\Controllers;

use App\Models\CursoModel;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $teste = CursoModel::all();
        dd($teste);
    }

}
