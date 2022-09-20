<?php

use Illuminate\Support\Facades\Route;
//controladores

use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VacacionesController;
use App\Http\Controllers\DescansosMedicosController;
use App\Http\Controllers\LicenciasController;
use App\Http\Controllers\AislamientosController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\SuspensionesController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\EditarController;

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

    Route::get('/general', [GeneralController::class, 'index'])->name('general');
    Route::post('/general', [GeneralController::class, 'consultar'])->name('general.consultar');

    Route::get('/vacaciones',[VacacionesController::class, 'index'])->name('vacaciones');
    Route::get('tablavacaciones',[VacacionesController::class,'tablavacaciones'])->name('tabla.vacaciones');

    Route::get('/licencias',[LicenciasController::class, 'index'])->name('licencias');
    Route::get('tablalicencias',[LicenciasController::class,'tablalicencias'])->name('tabla.licencias');

    Route::get('/descansosmedicos',[DescansosMedicosController::class, 'index'])->name('descansosmedicos');
    Route::get('tabladescansosmedicos',[DescansosMedicosController::class,'tabladescansosmedicos'])->name('tabla.descansosmedicos');

    Route::get('/aislamientos',[AislamientosController::class, 'index'])->name('aislamientos');
    Route::get('tablaaislamientos',[AislamientosController::class,'tablaaislamientos'])->name('tabla.aislamientos');

    Route::get('/suspensiones',[SuspensionesController::class, 'index'])->name('suspensiones');
    Route::get('tablasuspensiones',[SuspensionesController::class,'tablasuspensiones'])->name('tabla.suspensiones');

    Route::get('detalle/{cod}/crear',[RegistroController::class, 'registrar'])->name('registro.edit');
    Route::post('store', [RegistroController::class, 'store'])->name('store');
    Route::get('detalle/conceptos', [RegistroController::class, 'conceptos'])->name('conceptos.todos');
    Route::get('delete/{cod}', [RegistroController::class, 'desactivar'])->name('registro.delete');

    Route::get('vacaciones/export/', [VacacionesController::class, 'export'])->name('vacaciones.export');
    Route::get('suspensiones/export/', [SuspensionesController::class, 'export'])->name('suspensiones.export');
    Route::get('descansosmedicos/export/', [DescansosMedicosController::class, 'export'])->name('descansosmedicos.export');
    Route::get('licencias/export/', [LicenciasController::class, 'export'])->name('licencias.export');
    Route::get('aislamientos/export/', [AislamientosController::class, 'export'])->name('aislamientos.export');

    Route::get('cargamasiva', [RegistroController::class, 'cargamasiva'])->name('cargamasiva');
    Route::post('import', [RegistroController::class, 'import'])->name('import');

    Route::get('desactivar',[RegistroController::class, 'desactivar'])->name('desactivar.registro');

    Route::get('registro/{id}/editar', [EditarController::class, 'edit'])->name('registro.editar');
});
