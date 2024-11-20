<?php

use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TipoUsuarioController;
use Illuminate\Support\Facades\Route;

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

// **Logout** (apenas usuários autenticados)
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// **Rotas protegidas** - Exigem autenticação
Route::middleware(['auth'])->group(function () {

    // **Rotas de administradores** - Apenas administradores podem acessar
    Route::middleware(['checkRole:Administrador'])->group(function () {
        Route::resource('noticia', NoticiaController::class); // Apenas as ações de criação, atualização e edição
        Route::resource('usuario', UserController::class); // O administrador pode gerenciar usuários
        Route::resource('tipoUsuario', TipoUsuarioController::class);
    });

    // **Rotas de clientes** - Apenas clientes podem acessar
    /*Route::middleware(['checkRole:Cliente'])->group(function () {
        Route::resource('noticia', NoticiaController::class); // Apenas ações de notícias pessoais
    });*/
});
