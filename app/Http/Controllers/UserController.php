<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TipoUsuario;
use App\Models\Empresa;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $query = User::query();

        $tipoUsuario = TipoUsuario::all();

        $info = $query->get();

        return view('usuario.index', ["info"=>$info, "tipoUsuario"=>$tipoUsuario]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipoUsuario = TipoUsuario::all();
        $empresa = Empresa::all();

        return view('usuario.create', ["tipoUsuario"=>$tipoUsuario, "empresa"=>$empresa]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuario = new User();

        $usuario->name = $request->input('nome');
        $usuario->email = $request->input('email');
        $usuario->password = Hash::make($request->input('senha'));
        $usuario->tipo_usuario_id = $request->input('tipo_usuario_id');
        $usuario->empresa_id = $request->input('empresa_id');

        try {
            $usuario->save();
        } catch (\Exception $e) {
            return redirect()->route('usuario.index')->with('toast', ['type' => 'danger', 'message' => 'Erro: '.$e->getMessage()]);
        }

        return redirect()->route('usuario.index')->with('toast', ['type' => 'success', 'message' => 'Usuario adicionado com sucesso.']);
    }
    /**
     * Display the specified resource.
     */
    public function show(User $usuario)
    {
        $esp = $usuario;

        $tipoUsuario = TipoUsuario::find($usuario->tipo_usuario_id);
        $empresa = Empresa::find($usuario->empresa_id);

        return view('usuario.show', ["esp"=>$esp, "tipoUsuario"=>$tipoUsuario, "empresa"=>$empresa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        $info = $usuario;

        $tipoUsuario = TipoUsuario::all();

        $empresa = Empresa::all();

        return view('usuario.edit', ["info"=>$info, "tipoUsuario"=>$tipoUsuario, "empresa" => $empresa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {
        $usuario->name = $request->input('nome');
        $usuario->email = $request->input('email');
        $usuario->password = Hash::make($request->input('senha'));
        $usuario->tipo_usuario_id = $request->input('tipo_usuario_id');
        $usuario->empresa_id = $request->input('empresa_id');

        try {
            $usuario->save();
        } catch (\Exception $e) {
            return redirect()->route('usuario.index')->with('toast', ['type' => 'danger', 'message' => 'Erro Inesperado ('.$e->getMessage().")"]);
        }

        return redirect()->route('usuario.index')->with('toast', ['type' => 'success', 'message' => 'Usuario atualizado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        try {
            $usuario->delete();
        } catch (\Exception $e){
            if ($e instanceof \Illuminate\Database\QueryException && $e->errorInfo[1] == 1451) {
                return redirect()->route('usuario.index')->with('toast', ['type' => 'warning', 'message' => 'Não é Possível excluir itens com vínculos']);
            } else {
                return redirect()->route('usuario.index')->with('toast', ['type' => 'danger', 'message' => 'Erro Inesperado ('.$e->getMessage().")"]);
            }
        }

        return redirect()->route('usuario.index')->with('toast', ['type' => 'success', 'message' => 'Usuario deletado com sucesso.']);
    }
}
