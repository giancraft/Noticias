<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('login'); // Redireciona para o login caso não esteja autenticado
        }
    
        if ($role === 'Administrador') {
            if ($user->tipo_usuario_id !== 1) { // Assumindo que '1' é o ID do administrador
                return redirect()->route('noticia.index')->withErrors(['permissao' => 'Você não tem permissão para acessar essa área.']);
            }
        } elseif ($role === 'Cliente') {
            if ($user->tipo_usuario_id !== 5) { // Assumindo que '5' é o ID do cliente
                return redirect()->route('noticia.index')->withErrors(['permissao' => 'Você não tem permissão para acessar essa área.']);
            }
        }
    
        return $next($request);
    }
    
}
