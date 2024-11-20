<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckEmpresa
{
    public function handle($request, Closure $next)
    {
        $empresaId = session('empresa_id'); // Verifica se há uma empresa selecionada na sessão
        $user = Auth::user();

        if ($empresaId && $user->empresa_id != $empresaId) {
            return redirect()->route('login')->withErrors([
                'empresa' => 'Você não tem permissão para acessar esta empresa.',
            ]);
        }

        return $next($request);
    }
}
