<?php

use Illuminate\Support\Facades\Route;
//controladores

use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VacasionesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware'=>['auth']],function () {
    Route::resource('roles', RolController::class);    
    Route::resource('usuarios', UsuarioController::class);    

    //vistas general (Buscador)
    Route::get('/general', [GeneralController::class, 'index'])->name('general');
    Route::post('/general', [GeneralController::class, 'consultar'])->name('general.consultar');

    Route::get('/vacaciones',[VacasionesController::class, 'index'])->name('vacaciones');
});
