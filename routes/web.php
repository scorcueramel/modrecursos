<?php

use Illuminate\Support\Facades\Route;
//controladores

use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VacasionesController;
use App\Http\Controllers\DescansosMedicosController;
use App\Http\Controllers\LicenciasController;
use App\Http\Controllers\AislamientosController;
use App\Http\Controllers\SuspensionesController;

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

    //vacaciones
    Route::get('/vacaciones',[VacasionesController::class, 'index'])->name('vacaciones');
    Route::get('tablavacaciones',[PendientesController::class,'tablavacaciones'])->name('tabla.vacaciones');

    Route::get('/licencias',[LicenciasController::class, 'index'])->name('licencias');
    Route::get('/descansosmedicos',[DescansosMedicosController::class, 'index'])->name('descansosmedicos');
    
    Route::get('/aislamientos',[AislamientosController::class, 'index'])->name('aislamientos');
    Route::get('/suspensiones',[SuspensionesController::class, 'index'])->name('suspensiones');
});
