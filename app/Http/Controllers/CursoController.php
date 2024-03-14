<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Disciplina;

class CursoController extends Controller
{
    public function index() {
        $cursos = Curso::with('disciplinas')->get();
        return response()->json($cursos)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
    }

    public function store(Request $request) {
        $curso = new Curso;
        $curso->nome = $request->nome;
        $curso->anos = $request->anos;
        $curso->coordenador = $request->coordenador;
        $curso->tipo = $request->tipo;
        $curso->save();
        $curso->disciplinas()->attach($request->disciplina);
        return response()->json([
            "message" => "Curso adicionado!"
        ], 201)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
    }

    public function show($id) {
        $curso = Curso::with('disciplinas')->find($id);
        if(!empty($curso)){
            return response()->json($curso);
        } else{
            return response()->json([
                "message" => "Curso não encontrado!"
            ], 404)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        }
    }

    public function update(Request $request, $id) {
        if (Curso::where('id', $id)->exists()) {
            $curso = Curso::find($id);
            $curso->nome = is_null($request->nome) ? $curso->nome : $request->nome;
            $curso->anos = is_null($request->anos) ? $curso->anos : $request->anos;
            $curso->coordenador = is_null($request->coordenador) ? $curso->coordenador : $request->coordenador;
            $curso->tipo = is_null($request->tipo) ? $curso->tipo : $request->tipo;
            $curso->disciplinas()->sync($request->disciplina);
            $curso->save();
            return response()->json([
                "message" => "Curso atualizado"
            ], 202)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        } else{
            return response()->json([
                "message" => "Curso não encontrado"
            ], 404)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        }
    }

    public function destroy($id) {
        if (Curso::where('id', $id)->exists()) {
            $curso = Curso::find($id);
            $curso->disciplinas()->detach();
            $curso->delete();

            return response()->json([
                "message" => "Curso apagado!"
            ], 202)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        } else{
            return response()->json([
                "message" => "Curso não encontrado!"
            ], 404)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
        }
    }
}
