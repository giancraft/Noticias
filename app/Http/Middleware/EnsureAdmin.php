<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->tipo_usuario_id == 1) {
            return $next($request);
        }

        return redirect()->route('noticia.index')
            ->withErrors(['permissao' => 'Você não tem permissão para acessar essa área.']);
    }
}
