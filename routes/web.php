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

Route::group(['middleware' => ['checkUserAuth', 'checkUserRole']], function () {

    Route::get('user/dashboard', 'LoginController@index');
    
});
    

// Ajax view routes
Route::get('user/records/{ord?}/{sex_fil?}/{age_fil?}/{n_search?}', 'RecordsController@index')->middleware('checkUserAuth');
Route::get('user/singlerecord/{id}', 'RecordsController@showRecord')->middleware('checkUserAuth');
Route::get('message/summary', 'MessageController@showMessagesSummary')->middleware('checkUserAuth');
Route::get('message/icon', 'MessageController@showIconMessage')->middleware('checkUserAuth');

Route::get('user/messages', 'MessageController@get')->middleware('checkUserAuth');

Route::get('user/index', 'LoginController@indexDashboard')->middleware('checkUserAuth');

Route::get('user/news', 'NewsController@get')->middleware('checkUserAuth');

Route::get('video/getUserInfo', 'VideoCallController@getUserInfo')->middleware('checkUserAuth');
Route::get('comm/getContactInfo', 'MessageController@getContactInfo')->middleware('checkUserAuth');
Route::get('comm/updateReadMessages', 'MessageController@updateReadMessages')->middleware('checkUserAuth');
Route::get('comm/getUserFromId', 'MessageController@getUserFromId')->middleware('checkUserAuth');
Route::get('comm/viewMessagesFromMobile/{id}', 'MessageController@viewMessagesFromMobile')->middleware('checkUserAuth');
Route::post('comm/send', 'MessageController@send')->middleware('checkUserAuth');





/*Route::get('message/summary', function() {
    return view('ajax.messages_summary');
});*/

// Reset password routes
Route::get('/password/reset/{token?}', 'LoginController@forgotPassword');
Route::post('/passwordchanged', 'LoginController@changePassword');

// Generic purposes routes
Route::post('/user/login', 'LoginController@login');
Route::post('/user/loginForgotten', 'LoginController@loginForgotten');



Route::get('user/patient/{search?}/{ord?}', 'UsersManagementController@showPatients')->middleware('checkUserAuth');
Route::get('user/staff/{search?}/{ord?}', 'UsersManagementController@showStaff')->middleware('checkUserAuth');
Route::get('user/user/{search?}/{ord?}', 'UsersManagementController@showUsers')->middleware('checkUserAuth');
Route::get('user/newUser', 'UsersManagementController@newUser')->middleware('checkUserAuth');

Route::get('user/create', 'UsersManagementController@create')->middleware('checkUserAuth');


Route::post('user/logout', 'LoginController@logout');
Route::get('user/settings', 'RecordsController@settings')->middleware('checkUserAuth');

Route::post('user/avatarupdate/{id?}', [
    'uses' => 'RecordsController@updateAvatar',
    'as' => 'avatar.update'
]);


// Communication purposes routes
Route::get('user/my-messages', 'MessageController@showMyMessages')->middleware('checkUserAuth');
Route::get('user/my-messages/{id}', 'MessageController@showMessagesFromUser')->middleware('checkUserAuth');
Route::get('comm/messaging/{id?}', 'MessageController@showMessaging')->middleware('checkUserAuth');
Route::get('user/video-call', 'VideoCallController@showVideoCall')->middleware('checkUserAuth');
Route::post('user/video-call', 'VideoCallController@showVideoCall')->middleware('checkUserAuth');


/*
Route::get( 'user/recorddisplay/{id}', function ( $id) {
    fopen( resource_path( 'views/' . $id . '.blade.php' ), 'w' );
    return view($id);
});
*/

// Admin routes
Route::group(['middleware' => ['checkUserAuth', 'checkUserAdmin']], function () {

    Route::get('user/roleManagement', 'RoleController@index');
    Route::get('user/roleManagement/edit/{id}', 'RoleController@edit');
    Route::put('user/roleManagement/update', 'RoleController@update');
    Route::get('user/roleManagement/update', 'RoleController@update');

    Route::delete('role/delete/{id}', 'RoleController@destroy');
    Route::get('role/confirmDelete/{id}', 'RoleController@confirmDeleteRole');
    Route::get('role/userManagement/edit/{id}', 'RoleController@usersRolesView');
    Route::post('role/userManagementInRole/edit/{id}', 'RoleController@ajaxUserRolesDatatable');
    Route::post('roles/view', 'RoleController@ajaxViewMainRolesDatatable');

    Route::get('role/userManagementNotInRole/edit/{id}', 'RoleController@editNotInRole');
    Route::post('role/userManagementNotInRole/update', 'RoleController@updateNotInRole');
    Route::get('role/newRole', 'RoleController@newRole');
    Route::post('role/create', 'RoleController@create');
    
});

// Route::post('pusher/auth', 'VideoCallController@authenticatePusher');
Route::match(array('GET', 'POST'), 'pusher/auth', 'VideoCallController@authenticatePusher');


Route::get('test', function() {
    phpinfo();
});
/*

Route::resource('roles', 'RoleController');

Route::resource('staff', 'StaffController');

Route::resource('calls', 'CallController');

Route::resource('notes', 'NoteController');


Route::resource('patients', 'PatientController');
*/