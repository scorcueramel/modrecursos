<?php

use Illuminate\Support\Facades\Route;
//controladores

use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;

use App\Http\Controllers\CuartelesController;
use App\Http\Controllers\MausoleosController;
use App\Http\Controllers\TumbasController; 
use App\Http\Controllers\HomeController;

//TEST
use App\Http\Controllers\TestController;

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

// Route::get('/register', function(){
//     return view('auth.login');
// });

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware'=>['auth']],function () {
    Route::resource('roles', RolController::class);    
    Route::resource('usuarios', UsuarioController::class);    
    Route::resource('cuarteles', CuartelesController::class);    
    Route::resource('mausoleos', MausoleosController::class);    
    Route::resource('tumbas', TumbasController::class); 
    Route::get('cuarteles/{id}/delete', [CuartelesController::class, 'delete'])->name('del_c');
    Route::get('mausoleos/{id}/delete', [MausoleosController::class, 'delete'])->name('del_m');
    Route::get('tumbas/{id}/delete', [TumbasController::class, 'delete'])->name('del_t');   
    Route::get('tabletumbas',[TumbasController::class,'tablaTumbas'])->name('tumbas.tabla');
    Route::post('obtdetatumbas',[TumbasController::class,'detaTumba'])->name('obt.deta.tumbas');

    //TEST 
    Route::get('/general', [TestController::class, 'index'])->name('general');
});

Route::get('/exportarCuarteles', [App\Http\Controllers\CuartelesController::class, 'export'])->name('exportarCuarteles');
Route::get('/exportarMausoleos', [App\Http\Controllers\MausoleosController::class, 'export'])->name('exportarMausoleos');
Route::get('/exportarTumbas', [App\Http\Controllers\TumbasController::class, 'export'])->name('exportarTumbas');