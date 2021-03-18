<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//use \App\Controllers\UserController;
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
    $user = Auth::user(); //Check for session stablished
    if($user)
        return redirect()->action('LoginController@index');
    return view('login');
});

Route::group(['middleware' => ['isLogged', 'checkUserRole']], function () {

    Route::get('user/dashboard', 'LoginController@index');
    
});
    

// Ajax view routes
Route::get('user/records/{ord?}/{sex_fil?}/{age_fil?}/{n_search?}', 'RecordsController@index')->middleware('isLogged');
Route::get('user/singlerecord/{id}', 'RecordsController@showRecord')->middleware('isLogged');
Route::get('message/summary', 'MessageController@showMessagesSummary')->middleware('isLogged');
Route::get('message/icon', 'MessageController@showIconMessage')->middleware('isLogged');

Route::get('user/messages', 'MessageController@get')->middleware('isLogged');

Route::get('user/index', 'LoginController@indexDashboard')->middleware('isLogged')->name('indexDashboard');
Route::get('user/remember', 'LoginController@remember');


// Route::get('user/news', 'NewsController@get')->middleware('isLogged');

Route::get('video/getUserInfo', 'VideoCallController@getUserInfo')->middleware('isLogged');
Route::get('comm/getContactInfo', 'MessageController@getContactInfo')->middleware('isLogged');
Route::get('comm/updateReadMessages', 'MessageController@updateReadMessages')->middleware('isLogged');
Route::get('comm/getUserFromId', 'MessageController@getUserFromId')->middleware('isLogged');
Route::get('comm/viewMessagesFromMobile/{id}', 'MessageController@viewMessagesFromMobile')->middleware('isLogged');
Route::post('comm/send', 'MessageController@send')->middleware('isLogged');
Route::delete('comm/deleteMessageChat', 'MessageController@delete')->middleware('isLogged');


/*Route::get('message/summary', function() {
    return view('ajax.messages_summary');
});*/

// Reset password routes
Route::get('/password/reset/{token?}', 'LoginController@forgotPassword');
Route::post('/passwordchanged', 'LoginController@changePassword');

// Generic purposes routes
Route::post('/user/login', 'LoginController@login');
Route::post('/user/loginForgotten', 'LoginController@loginForgotten');

// User routes
Route::get('users/edit/{id}', 'UserController@edit')->middleware('isLogged')->name('users.edit');//->where('id', '\d+');;

Route::get('users/{userType?}/{search?}/{ord?}', 'UserController@index')->middleware('isLogged')->where('userType', 'staff|patient');
// TODO: How to route without a word (edit). Possible solution->Routing without the search and ord parameters
Route::put('users/{id}', 'UserController@update')->middleware('isLogged');
// TODO: Preguntar: Para qué le tengo que pasar el id al update, si ya se obtienen los argumentos con Request
// route('users.edit', ['id'=>25])


Route::get('user/staff/{search?}/{ord?}', 'UsersManagementController@showStaff')->middleware('isLogged');
Route::get('user/patient/{search?}/{ord?}', 'UsersManagementController@showPatients')->middleware('isLogged');
Route::get('user/user/{search?}/{ord?}', 'UsersManagementController@showUsers')->middleware('isLogged');
Route::get('user/newUser', 'UsersManagementController@newUser')->middleware('isLogged');

Route::post('user/create', 'UsersManagementController@create')->middleware('isLogged');
Route::get('user/edit/{id}', 'UsersManagementController@edit')->middleware('isLogged');
Route::post('user/editUser', 'UsersManagementController@editUser')->middleware('isLogged');
Route::get('user/createUserFromMail/{token?}', 'UsersManagementController@createUserFromMail');


Route::post('user/createNewUser', 'UsersManagementController@createNewUser');

Route::get('user/logout', 'LoginController@logout');
Route::post('user/logout', 'LoginController@logout');
Route::get('user/settings', 'RecordsController@settings')->middleware('isLogged');

Route::post('user/avatarupdate/{id?}', [
    'uses' => 'RecordsController@updateAvatar',
    'as' => 'avatar.update'
]);

//Rutas para las citas médicas (Appointments)
// Route::get('/appointments', 'AppointmentController@index')->name('index');
// Route::get('appointment/{id}', 'AppointmentController@edit');
Route::get('/appointment/listPending', 'AppointmentController@listPending')->middleware('isLogged');
Route::get('/appointment/listAccepted', 'AppointmentController@listAccepted')->middleware('isLogged');

Route::get('/appointment/calendar', 'AppointmentController@calendar')->middleware('isLogged');
Route::get('/appointment/showCalendar/{id}', 'AppointmentController@showCalendar')->middleware('isLogged');

Route::resource('appointment', 'AppointmentController')->middleware('isLogged');

// TODO: Enviar mail información de cita pendiente con doctor x. Entrar en link para validar.
// Si el paciente rechaza cita el doctor y admin reciben email de paciente ha rechazado cita con motivo

// Communication purposes routes
Route::get('user/my-messages', [MessageController::class, "showMyMessages"])->middleware('isLogged');
Route::get('user/my-messages', 'MessageController@showMyMessages')->middleware('isLogged');
Route::get('user/my-messages/{id}', 'MessageController@showMessagesFromUser')->middleware('isLogged');
Route::get('comm/messaging/{id?}', 'MessageController@showMessaging')->middleware('isLogged');
Route::get('user/video-call', 'VideoCallController@showVideoCall')->middleware('isLogged');
Route::post('user/video-call', 'VideoCallController@showVideoCall')->middleware('isLogged');

// Route::post('user/video-call-container', 'VideoCallController@showVideoCallContainer')->middleware('isLogged');
// TODO: only post
Route::match(array('GET', 'POST'), 'user/video-call-container', 'VideoCallController@showVideoCallContainer')->middleware('isLogged');


Route::get('communication/video-room/{sessionRoom}', 'VideoCallController@showVideoRoom')->middleware('isLogged');

/*
Route::get( 'user/recorddisplay/{id}', function ( $id) {
    fopen( resource_path( 'views/' . $id . '.blade.php' ), 'w' );
    return view($id);
});
*/

// Admin routes
Route::group(['middleware' => ['isLogged']], function () {

    // Route::get('user/roleManagement', 'RoleController@index');
    // Route::get('user/roleManagement/edit/{id}', 'RoleController@edit')->middleware('isAdmin');
    // Route::put('user/roleManagement/update', 'RoleController@update');
    // Route::get('user/roleManagement/update', 'RoleController@update');

    Route::delete('role/destroy/{id}', 'RoleController@destroy');
    // Route::get('role/confirmDelete/{id}', 'RoleController@confirmDeleteRole');
    Route::get('role/userManagement/edit/{id}', 'RoleController@usersRolesView');
    Route::post('role/userManagementInRole/edit/{id}', 'RoleController@ajaxUserRolesDatatable');
    Route::post('roles/viewDT', 'RoleController@ajaxViewMainRolesDatatable');
    Route::get('roles/viewDT', 'RoleController@ajaxViewMainRolesDatatable');


    Route::get('role/userManagementNotInRole/edit/{id}', 'RoleController@editNotInRole');
    Route::post('role/userManagementNotInRole/update', 'RoleController@updateNotInRole');
    // Route::get('role/newRole', 'RoleController@newRole');
    // Route::post('role/create', 'RoleController@create');

    // Route::get('role/create', 'RoleController@create');

    Route::get('roles/isDelible', 'RoleController@isDelible');

    Route::get('roles/{id}/confirmDelete', 'RoleController@confirmDelete')->name('roles.confirmDelete');

    Route::resource('roles', 'RoleController');
    // Route::apiResource('roles', 'RoleController');


    
});

// Route::post('pusher/auth', 'VideoCallController@authenticatePusher');
Route::match(array('GET', 'POST'), 'pusher/auth', 'VideoCallController@authenticatePusher')->middleware('isLogged');;


Route::get('test', function() {
    phpinfo();
});

Route::get('/sms/send', 'SmsController@sendSms')->middleware('isLogged');;
Route::post('/sms/send', 'SmsController@postSendSms')->middleware('isLogged');;

/*

Route::resource('roles', 'RoleController');

Route::resource('staff', 'StaffController');

Route::resource('calls', 'CallController');

Route::resource('notes', 'NoteController');

Route::resource('patients', 'PatientController');
*/

Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});


/*
 * TEST purposes
 */
Route::get('    ', function() {
    return new App\Mail\InvitationNewUserMail('aogyuaogahg', '111111b');
});

