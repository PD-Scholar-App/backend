<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;

class DisciplinaController extends Controller
{
    public function index() {
        $disciplinas = Disciplina::all();
        //$disciplinas = Disciplina::with('cursos')->get();
        return response()->json($disciplinas)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
    }

    public function store(Request $request) {
        $disciplina = new Disciplina;
        $disciplina->nome = $request->nome;
        $disciplina->tipo = $request->tipo;
        $disciplina->etcs = $request->etcs;
        //$disciplina->cursos()->attach($request->curso);
        $disciplina->save();
        return response()->json([
            "message" => "Disciplina adicionada!"
        ], 201)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
    }

    public function show($id) {
        $disciplina = Disciplina::find($id);
        //$disciplina = Disciplina::with('cursos')->find($id);
        if(!empty($disciplina)){
            return response()->json($disciplina);
        } else{
            return response()->json([
                "message" => "Disciplina não encontrada!"
            ], 404)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        }
    }

    public function update(Request $request, $id) {
        if (Disciplina::where('id', $id)->exists()) {
            $disciplina = Disciplina::find($id);
            $disciplina->nome = is_null($request->nome) ? $disciplina->nome : $request->nome;
            $disciplina->anos = is_null($request->anos) ? $disciplina->anos : $request->anos;
            $disciplina->coordenador = is_null($request->coordenador) ? $disciplina->coordenador : $request->coordenador;
            $disciplina->tipo = is_null($request->tipo) ? $disciplina->tipo : $request->tipo;
            //$disciplina->curso = $disciplina->cursos()->sync($disciplina->curso);
            $disciplina->save();
            return response()->json([
                "message" => "Disciplina atualizada!"
            ], 202)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        } else{
            return response()->json([
                "message" => "Disciplina não encontrada!"
            ], 404)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        }
    }

    public function destroy($id) {
        if (Disciplina::where('id', $id)->exists()) {
            $disciplina = Disciplina::find($id);
            $disciplina->cursos()->detach();
            $disciplina->delete();

            return response()->json([
                "message" => "Disciplina apagada!"
            ], 202)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        } else{
            return response()->json([
                "message" => "Disciplina não encontrada!"
            ], 404)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        }
    }
}
