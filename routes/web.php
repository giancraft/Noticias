<?php

use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TipoUsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/noticia', NoticiaController::class)->parameters([
    'noticia' => 'noticia',
]);

Route::resource('/usuario', UserController::class);
Route::resource('/tipoUsuario', TipoUsuarioController::class);
