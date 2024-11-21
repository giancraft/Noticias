<?php

use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TipoUsuarioController;
use Illuminate\Support\Facades\Route;

// **Rotas protegidas** - Exigem autenticação
Route::middleware(['auth', 'checkAccess'])->group(function () {
    \Log::info('Dentro das rotas protegidas');

    // **Rotas de notícias protegidas** (somente administradores e clientes podem criar/editar/excluir)
    
    // Usando a rota resource para criar, editar e excluir notícias
    Route::resource('noticia', NoticiaController::class)->except(['index', 'show'])
    ->parameters([
        'noticia' => 'noticia'  // Aqui você personaliza o nome do parâmetro se necessário
    ]);  // Exclui 'index' e 'show' que já são públicas
    
    // Rotas de usuários (somente administradores)
    Route::middleware('admin')->group(function() {
        Route::resource('usuario', UserController::class);
        Route::resource('tipoUsuario', TipoUsuarioController::class);
    });
});


// Página inicial
Route::get('/', function () {
    return redirect()->route('noticia.index'); // Redireciona para a lista de notícias
});

// **Rotas públicas** - Não exigem autenticação
Route::get('noticia', [NoticiaController::class, 'index'])->name('noticia.index'); // Listagem de notícias
Route::get('noticia/{noticia}', [NoticiaController::class, 'show'])->name('noticia.show'); // Visualizar notícia específica

// **Rotas de autenticação** - Exigem que o usuário não esteja autenticado
Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

// **Logout** - Disponível para usuários autenticados
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


