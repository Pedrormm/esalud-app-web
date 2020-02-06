<?php

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
    //session()->flash('info', 'pepe');
    return view('login');
});

Route::post('/user/login', 'LoginController@login');
Route::get('user/dashboard', 'LoginController@index')->middleware('checkUserAuth');
Route::get('user/records', 'RecordsController@index')->middleware('checkUserAuth');

//dd(false);
//TODO: Crear un middleware siguiendo el tutorial oficial (se hace con artisan) y llamarlo CheckUserLogged y que lo use el endpoint user/dashboard
//Este middlerware que simplemente compruebe si el usuario está autenticado y si no es asi redirija a / con un mensaje en una flashsession del estilo "Tu sesion ha caducado por inactividad". Este flashsession debe capturarse en la pagina de login para imprimir el mensaje
Route::get('user/logout', 'LoginController@logout');
Route::get('test', function() {
    phpinfo();
});
Route::get('user/messages', function() {
    return view('ajax/messages');
});