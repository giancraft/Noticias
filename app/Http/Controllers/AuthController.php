<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Empresa;
use App\Models\TipoUsuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $empresas = Empresa::all();
        return view('auth.login', ["empresas"=>$empresas]);
    }

    public function showRegisterForm()
    {
        $info = TipoUsuario::all();
        $empresas = Empresa::all();
        return view('auth.register', ["info" => $info, "empresas" => $empresas]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'email' => 'required|string|email|max:45|unique:users',
            'password' => 'required|string|min:4',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo_usuario_id' => $request->tipo_usuario_id,
            'empresa_id' => $request->empresa_id,
        ]);
    
        Auth::login($user);
    
        return redirect()->route('noticia.index');
    }
    

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Verifica se o usuário existe e se ele está na empresa correta
        $user = User::where('email', $request->email)
            ->where('empresa_id', $request->empresa_id)
            ->first();

        if ($user && Auth::attempt($credentials)) {
            return redirect()->route('noticia.index');
        }

        // Caso o login falhe
        return redirect()->back()->withErrors(['login' => 'Credenciais inválidas ou empresa incorreta.'])->withInput();
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }    
}
