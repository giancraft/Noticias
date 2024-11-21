<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        \Log::info('Verificando acesso do usuário: ' . $user->id);

    
        // Verifica se o usuário está autenticado
        if (!$user) {
            \Log::info('Usuário não autenticado.');
            return redirect()->route('noticia.index');
        }
    
        // Envia uma requisição para o serviço Node.js para validar o tipo de usuário
        $response = Http::post('http://localhost:3001/validate-access', [
            'tipo_usuario' => $user->tipo_usuario_id,
        ]);
    
        // Verifica a resposta do Node.js
        $access = $response->json()['access'];
        \Log::info('Resposta do Node.js: ' . $access);
    
        if ($access === 'admin' || $access === 'client') {
            \Log::info('Acesso permitido para o usuário: ' . $user->id);
            return $next($request);  // Permite o acesso
        }
    
        \Log::info('Acesso negado para o tipo de usuário: ' . $user->tipo_usuario_id);
        return redirect()->route('noticia.index')->withErrors(['permissao' => 'Você não tem permissão para acessar essa área.']);
    }    
}
