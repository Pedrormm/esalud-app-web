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
Route::get('user/records/{ord?}/{sex_fil?}/{age_fil?}/{n_search?}', 'RecordsController@index')->middleware('checkUserAuth');

 Route::get('user/singlerecord/{id}', 'RecordsController@showRecord')->middleware('checkUserAuth');
/*
Route::get( 'user/recorddisplay/{id}', function ( $id) {
    fopen( resource_path( 'views/' . $id . '.blade.php' ), 'w' );
    return view($id);
});
*/

Route::get('user/patients/', 'UsersManagementController@patients')->middleware('checkUserAuth');


Route::get('user/logout', 'LoginController@logout');
Route::get('test', function() {
    phpinfo();
});
Route::get('user/messages', 'MessageController@get')->middleware('checkUserAuth');