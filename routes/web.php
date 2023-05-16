<?php

use App\Models\Mensaje;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    return view('welcome');
});

Route::get('/home', function () {
    $mensaje = new Mensaje();
    return view('home', compact('mensaje'));
});

Auth::routes();


Route::group(['namespace' => 'App\Http\Controllers', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');
    Route::resource('usuarios', UserController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('accesos', AccesoController::class);
    Route::resource('registros', RegistroController::class);
    Route::resource('respuestas', RespuestaController::class);
    Route::resource('formulario', FormularioController::class);
    Route::resource('contenido', ContenidoController::class);
    Route::resource('roles', RolController::class);
    Route::resource('mensaje', MensajeController::class);
});
Route::resource('/form/{id}/{empresa}/{evento}', App\Http\Controllers\FormController::class);
Route::resource('message', App\Http\Controllers\MensajeController::class);

Route::group(['prefix' => 'img'], function () {
    Route::get('email-fondo', function () { return response()->file('img/email/image1.jpg');});
    Route::get('email-icono1', function () { return response()->file('img/email/ico_facebook.jpg');});
    Route::get('email-icono2', function () { return response()->file('img/email/ico_linkedin.jpg');});
});
