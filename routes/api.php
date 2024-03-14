<?php

use App\Http\Controllers\CursoController;
use App\Http\Controllers\DisciplinaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cursos', [CursoController::class, 'index']);
Route::get('/cursos/{id}', [CursoController::class, 'show']);
Route::post('/cursos', [CursoController::class, 'store']);
Route::put('/cursos/{id}', [CursoController::class, 'update']);
Route::delete('/cursos/{id}', [CursoController::class, 'destroy']);

Route::get('/disciplinas', [DisciplinaController::class, 'index']);
Route::get('/disciplinas/{id}', [DisciplinaController::class, 'show']);
Route::post('/disciplinas', [DisciplinaController::class, 'store']);
Route::put('/disciplinas/{id}', [DisciplinaController::class, 'update']);
Route::delete('/disciplinas/{id}', [DisciplinaController::class, 'destroy']);