<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index(){

        return response()->json(Noticia::all());
    }
    
    public function store(Request $request){

        $user = auth('sanctum')->user();
        if(! $user->can('create', Noticia::class)){
            return response()->json(['error' => 'Você não tem permissão para criar uma notícia'], 403);
        }

        $noticia = Noticia::create($request->all());

        return response()->json($noticia, 201);
    }
    
    public function show(Noticia $noticia){

        $user = auth('sanctum')->user();
        if(! $user->can('view', $noticia)){
            return response()->json(['error' => 'Você não tem permissão para acessar essa notícia'], 403);
        }
    
      return response()->json($noticia, 200);
    }

    public function update(Noticia $noticia, Request $request){

        $user = auth('sanctum')->user();
        if(! $user->can('update', $noticia)){
            return response()->json(['error' => 'Você não tem permissão para editar essa notícia'], 403);
        }

        $noticia->titulo = $request->titulo;
        $noticia->descricao = $request->descricao;
        $noticia->user_id = $request->user_id;
        $noticia->save();

        return response()->json($noticia, 200);
    }

    public function destroy(Noticia $noticia){

        $user = auth('sanctum')->user();
        if(! $user->can('delete', $noticia)){
            return response()->json(['error' => 'Você não tem permissão para deletar essa notícia'], 403);
        }

        Noticia::destroy($noticia->id);

        return response()->noContent();
    }
}