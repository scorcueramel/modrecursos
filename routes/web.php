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

    //TEST 
    Route::get('/general', [TestController::class, 'index'])->name('general');
});
