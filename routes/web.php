<?php

use App\Http\Controllers\CursoController;
use App\Http\Controllers\AlunoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [CursoController::class, 'index']);

Route::get('/alunos', [AlunoController::class, 'index']);


Route::post('/curso', [CursoController::class, 'createOrUpdateCurso']);

Route::get('/deleteCurso/{id}', [CursoController::class, 'deleteCurso']);


Route::post('/aluno', [AlunoController::class, 'createOrUpdateAluno']);

Route::get('/deleteAluno/{id}', [AlunoController::class, 'deleteAluno']);
