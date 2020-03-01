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
// Full view routes
Route::get('/', function () {
    //session()->flash('info', 'pepe');
    $user = Auth::user(); //Check for session stablished
    if($user)
        return redirect()->action('LoginController@index');
    return view('login');
});
Route::get('user/dashboard', 'LoginController@index')->middleware('checkUserAuth');

// Ajax view routes
Route::get('user/records/{ord?}/{sex_fil?}/{age_fil?}/{n_search?}', 'RecordsController@index')->middleware('checkUserAuth');
Route::get('user/singlerecord/{id}', 'RecordsController@showRecord')->middleware('checkUserAuth');

// Reset password routes
Route::get('/password/reset/{token?}', 'LoginController@forgotPassword');
Route::post('/passwordchanged', 'LoginController@changePassword');

// Generic purposes routes
Route::post('/user/login', 'LoginController@login');
Route::post('/user/loginForgotten', 'LoginController@loginForgotten');

/*
Route::get( 'user/recorddisplay/{id}', function ( $id) {
    fopen( resource_path( 'views/' . $id . '.blade.php' ), 'w' );
    return view($id);
});
*/
Route::get('user/patient/{search?}/{ord?}', 'UsersManagementController@showPatients')->middleware('checkUserAuth');
Route::get('user/staff/{search?}/{ord?}', 'UsersManagementController@showStaff')->middleware('checkUserAuth');
Route::get('user/user/{search?}/{ord?}', 'UsersManagementController@showUsers')->middleware('checkUserAuth');


Route::post('user/logout', 'LoginController@logout');
Route::get('test', function() {
    phpinfo();
});
Route::get('user/messages', 'MessageController@get')->middleware('checkUserAuth');

Route::get('user/news', 'NewsController@get')->middleware('checkUserAuth');