<?php

namespace App\Http\Controllers;

use App\Models\TipoUsuario;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = TipoUsuario::query();

        $info = $query->get();

        return view('tipoUsuario.index', ["info"=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipoUsuario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tipoUsuario = new TipoUsuario();

        $tipoUsuario->nome = $request->input('nome');
        
        try {
            $tipoUsuario->save;
        } catch (\Exception $e) {
            return redirect()->route('tipoUsuario.index')->with('toast', ['type' => 'danger', 'message' => 'Erro Inesperado ('.$e->getMessage().")"]);
        }

        return redirect()->route('tipoUsuario.index')->with('toast', ['type' => 'success', 'message' => 'TipoUsuario adicionado com sucesso.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoUsuario $tipoUsuario)
    {
        $esp = $tipoUsuario;

        return view('tipoUsuario.show', ["esp"=>$esp]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoUsuario $tipoUsuario)
    {
        $info = $tipoUsuario;

        return view('tipoUsuario.edit', ["info"=>$info]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoUsuario $tipoUsuario)
    {
        $tipoUsuario->nome = $request->input('nome');

        try {
            $tipoUsuario->save;
        } catch (\Exception $e) {
            return redirect()->route('tipoUsuario.index')->with('toast', ['type' => 'danger', 'message' => 'Erro Inesperado ('.$e->getMessage().")"]);
        }

        return redirect()->route('tipoUsuario.index')->with('toast', ['type' => 'success', 'message' => 'TipoUsuario atualizado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoUsuario $tipoUsuario)
    {
        try {
            $tipoUsuario->delete();
        } catch (\Exception $e){
            if ($e instanceof \Illuminate\Database\QueryException && $e->errorInfo[1] == 1451) {
                return redirect()->route('tipoUsuario.index')->with('toast', ['type' => 'warning', 'message' => 'Não é Possível excluir itens com vínculos']);
            } else {
                return redirect()->route('tipoUsuario.index')->with('toast', ['type' => 'danger', 'message' => 'Erro Inesperado ('.$e->getMessage().")"]);
            }
        }

        return redirect()->route('tipoUsuario.index')->with('toast', ['type' => 'success', 'message' => 'TipoUsuario deletado com sucesso.']);
    }
}
