<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\User;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Noticia::query();

        $usuario = User::all();
        $info = $query->get();

        return view('noticia.index', ["info"=>$info, "usuarios"=>$usuario]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = User::all();

        return view('noticia.create', ["info"=>$info]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $noticia = new Noticia();

        $noticia->titulo = $request->input('titulo');
        $noticia->conteudo = $request->input('conteudo');
        $noticia->user_id = $request->input('user_id');

        try {
            $noticia->save;
        } catch (\Exception $e) {
            return redirect()->route('noticia.index')->with('toast', ['type' => 'danger', 'message' => 'Erro Inesperado ('.$e->getMessage().")"]);
        }

        return redirect()->route('noticia.index')->with('toast', ['type' => 'success', 'message' => 'Notícia adicionada com sucesso.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Noticia $noticia)
    {
        $esp = $noticia;

        $user = User::find($noticia->user_id);

        return view('noticia.show', ["esp"=>$esp, "user"=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Noticia $noticia)
    {
        $info = $noticia;

        $user = User::all();

        return view('noticia.edit', ["info"=>$info, "user"=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Noticia $noticia)
    {
        $noticia->titulo = $request->input('titulo');
        $noticia->conteudo = $request->input('conteudo');
        $noticia->user_id = $request->input('user_id');

        try {
            $noticia->save;
        } catch (\Exception $e) {
            return redirect()->route('noticia.index')->with('toast', ['type' => 'danger', 'message' => 'Erro Inesperado ('.$e->getMessage().")"]);
        }

        return redirect()->route('noticia.index')->with('toast', ['type' => 'success', 'message' => 'Notícia atualizada com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Noticia $noticia)
    {
        try {
            $noticia->delete();
        } catch (\Exception $e){
            if ($e instanceof \Illuminate\Database\QueryException && $e->errorInfo[1] == 1451) {
                return redirect()->route('noticia.index')->with('toast', ['type' => 'warning', 'message' => 'Não é Possível excluir itens com vínculos']);
            } else {
                return redirect()->route('noticia.index')->with('toast', ['type' => 'danger', 'message' => 'Erro Inesperado ('.$e->getMessage().")"]);
            }
        }

        return redirect()->route('noticia.index')->with('toast', ['type' => 'success', 'message' => 'Notícia deletada com sucesso.']);
    }
}
