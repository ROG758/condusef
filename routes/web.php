<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccesoController;
use App\Http\Controllers\personalController;
use App\Http\Controllers\SistemaUsuarioController;
use App\Http\Controllers\UsuarioVistaController;
use App\Http\Controllers\VicepresidenciaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded byUsuarioVistaController the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


route::group(['middleware' => ['auth']], function () {
    Route::POST('sistemas/pdf', [SistemaUsuarioController::class, 'pdf'])->name('sistemas.pdf');
    Route::GET('/obtener-datos-acce', [SistemaUsuarioController::class,'obtenerDatosAccesoJson'])->name('obtener-datos-acce');
    Route::GET('/obtener-datos-usuario', [SistemaUsuarioController::class,'obtenerDatosUsuarioJson'])->name('obtener-datos-usuario');
    Route::GET('/obtener-datos-vicepresidencia',[SistemaUsuarioController::class,'obtenerDatosVicepresidenciaJson'])->name('obtener-datos-vicepresidencia');
    Route::get('/obtener-datos-area', [SistemaUsuarioController::class, 'obtenerAreaJson'])->name('obtener-datos-area');
    Route::post('/actualizar-status', [SistemaUsuarioController::class, 'UpdateStatus'])->name('actualizar-status');
    Route::post('/export', [SistemaUsuarioController::class, 'export'])->name('export');
    Route::resource('acceso', AccesoController::class);
    Route::resource('personal', personalController::class);
    Route::resource('sistemas', SistemaUsuarioController::class);
    Route::resource('vista', UsuarioVistaController::class);
    Route::resource('vicepresidencia',VicepresidenciaController::class);
    
});
