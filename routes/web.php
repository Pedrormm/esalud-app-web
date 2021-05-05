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
    Route::get('dashboard', 'LoginController@index')->name('dashboard.index');
});

// Reset password routes
Route::get('/password/reset/{token?}', 'LoginController@forgotPassword');
Route::post('/passwordChanged', 'LoginController@changePassword');
Route::get('isPasswordForgotten', 'LoginController@isPasswordForgotten');

// Generic login purposes routes
Route::post('/login', 'LoginController@login');
Route::post('/loginForgotten', 'LoginController@loginForgotten');
Route::match(array('GET', 'POST'), 'logout', 'LoginController@logout');

// Settings and profile routes
Route::get('user/settings', 'RecordsController@settings')->middleware('isLogged');
Route::post('user/avatarupdate/{id?}', [
    'uses' => 'RecordsController@updateAvatar',
    'as' => 'avatar.update'
]);

// User creation routes
Route::get('user/newUser', '    @newUser')->middleware('isLogged');
Route::post('user/create', 'UsersManagementController@create')->middleware('isLogged');
Route::get('user/createUserFromMail/{token?}', 'UsersManagementController@createUserFromMail');
Route::post('user/createNewUser', 'UsersManagementController@createNewUser');

// User routes
Route::get('users/{id}/confirmDelete', 'UserController@confirmDelete');
Route::match(array('GET', 'POST'), 'users/viewDT', 'UserController@ajaxViewDatatable');
Route::resource('users', 'UserController')->middleware('checkPermissionRoutes');

// Patient routes
Route::get('patients/{id}/confirmDelete', 'PatientController@confirmDelete');
Route::match(array('GET', 'POST'), 'patients/viewDT', 'PatientController@ajaxViewDatatable');
Route::resource('patients', 'PatientController');

// Staff routes
Route::get('staff/{id}/confirmDelete', 'StaffController@confirmDelete');
Route::match(array('GET', 'POST'), 'staff/viewDT', 'StaffController@ajaxViewDatatable');
Route::resource('staff', 'StaffController');

// Schedule routes
Route::match(array('GET', 'POST'), 'schedule/viewDT', 'ScheduleController@ajaxViewDatatable')->middleware('isLogged');
Route::match(array('GET', 'POST'), 'schedule/generateSchedule', 'ScheduleController@generateSchedule')->middleware('isLogged');
Route::patch('schedule/saveSchedule/{id?}', 'ScheduleController@saveSchedule')->middleware('isLogged');
Route::get('schedule', 'ScheduleController@index')->middleware('isLogged');
Route::get('schedule/staff', 'ScheduleController@getStaff')->middleware('isLogged');
Route::get('schedule/staff/{id}', 'ScheduleController@showSchedule')->middleware('isLogged');
Route::delete('schedule/{id}', 'ScheduleController@destroy');

// Medical treatment routes
Route::get('treatments/{id}/confirmDelete', 'TreatmentController@confirmDelete');
Route::match(array('GET', 'POST'), 'treatments/viewDT', 'TreatmentController@ajaxViewDatatable');
Route::match(array('GET', 'POST'), 'treatments/singlePatient/{id}/viewDT', 'TreatmentController@ajaxViewDatatableSP');
Route::get('treatments/{id}/indexSinglePatient', 'TreatmentController@indexSinglePatient');
Route::post('treatments/indexSinglePatient', 'TreatmentController@indexSinglePatient');
Route::resource('treatments', 'TreatmentController')->middleware('checkPermissionRoutes');

// Records routes
Route::match(array('GET', 'POST'), 'records', 'RecordsController@index')->middleware('isLogged');
Route::get('singleRecord/{id}', 'RecordsController@showRecord')->middleware('isLogged');
Route::get('ownRecord', 'RecordsController@showOwnRecord')->middleware('isLogged')->middleware('checkPermissionRoutes');

// Dashboard ajax tabs routes
Route::get('dashboard/frontPage', 'DashboardController@frontPageDashboard')->middleware('isLogged')->name('frontPageDashboard');
// Route::get('dashboard/news', 'NewsController@get')->middleware('isLogged');
Route::get('dashboard/fillMsgTable', 'DashboardController@fillMsgTable')->middleware('isLogged');


/*
 * Communication purposes routes
*/
Route::match(array('GET', 'POST'), 'pusher/auth', 'VideoCallController@authenticatePusher')->middleware('isLogged');;
Route::get('messaging/myMessages', 'MessageController@showMyMessages')->middleware('isLogged');
Route::get('messaging/myMessages/{id}', 'MessageController@showMessagesFromUser')->middleware('isLogged');

// Messaging routes
Route::get('messaging/summary', 'MessageController@showMessagesSummary')->middleware('isLogged');
Route::get('messaging/icon', 'MessageController@showIconMessage')->middleware('isLogged');
Route::get('messaging/getMessages', 'MessageController@get')->middleware('isLogged');
Route::get('messaging/getContactInfo', 'MessageController@getContactInfo')->middleware('isLogged');
Route::get('messaging/updateReadMessages', 'MessageController@updateReadMessages')->middleware('isLogged');
Route::get('messaging/getUserFromId', 'MessageController@getUserFromId')->middleware('isLogged');
Route::get('messaging/viewMessagesFromMobile/{id}', 'MessageController@viewMessagesFromMobile')->middleware('isLogged');
Route::post('messaging/send', 'MessageController@send')->middleware('isLogged');
Route::delete('messaging/deleteMessageChat', 'MessageController@delete')->middleware('isLogged');
Route::get('messaging', 'MessageController@showMessaging')->middleware('isLogged');

// VideoCall routes
Route::get('videoCall/getUserInfo', 'VideoCallController@getUserInfo')->middleware('isLogged');
Route::match(array('GET', 'POST'), 'videoCall', 'VideoCallController@showVideoCall')->middleware('isLogged');
Route::match(array('GET', 'POST'), 'videoCallContainer', 'VideoCallController@showVideoCallContainer')->middleware('isLogged');
Route::get('videoRoom/{sessionRoom}', 'VideoCallController@showVideoRoom')->middleware('isLogged');

// Appointments routes
// Route::get('/appointments', 'AppointmentController@index')->name('index')->middleware('isLogged');
// Route::get('appointment/{id}', 'AppointmentController@edit')->middleware('isLogged');
Route::match(array('GET', 'POST'), 'appointment/viewDT', 'AppointmentController@ajaxViewDatatable')->middleware('isLogged');
Route::match(array('GET', 'POST'), 'appointment/{id}/confirmChecked/{checked}', 'AppointmentController@confirmChecked')->middleware('isLogged');
Route::match(array('GET', 'POST'), 'appointment/{id}/confirmAccomplished/{accomplished}', 'AppointmentController@confirmAccomplished')->middleware('isLogged');
Route::match(array('GET', 'POST'), 'appointment/{id}/setChecked/{checked}/{mailable?}', 'AppointmentController@setChecked')->middleware('isLogged');
Route::post('appointment/{id}/setAccomplished/{accomplished}', 'AppointmentController@setChecked')->middleware('isLogged');
Route::get('appointment/realDoctorSchedule', 'AppointmentController@realDoctorSchedule')->middleware('isLogged');
Route::get('appointment/listPending', 'AppointmentController@listPending')->middleware('isLogged');
Route::get('appointment/listAccepted', 'AppointmentController@listAccepted')->middleware('isLogged');
Route::get('appointment/calendar', 'AppointmentController@calendar')->middleware('isLogged');
Route::get('appointment/showCalendar/{id}', 'AppointmentController@showCalendar')->middleware('isLogged');
// Route::resource('appointment/all', 'AppointmentController')->middleware('isLogged');
Route::resource('appointment', 'AppointmentController')->middleware('isLogged');

// SMS routes
Route::match(array('GET', 'POST'), 'sms/send', 'SmsController@sendSms')->middleware('isLogged');
// Route::get('/sms/send', 'SmsController@sendSms')->middleware('isLogged');
// Route::post('/sms/send', 'SmsController@postSendSms')->middleware('isLogged');

// Roles routes
Route::group(['middleware' => ['isLogged']], function () {

    Route::get('roles/userManagement/edit/{id}', 'RoleController@usersRolesView');
    Route::post('roles/userManagementInRole/edit/{id}', 'RoleController@ajaxUserRolesDatatable');

    Route::get('roles/userManagementNotInRole/edit/{id}', 'RoleController@editNotInRole');
    Route::post('roles/userManagementNotInRole/update', 'RoleController@updateNotInRole');

    Route::match(array('GET', 'POST'), 'roles/viewDT', 'RoleController@ajaxViewMainRolesDatatable');

    Route::get('roles/isDelible', 'RoleController@isDelible');

    Route::get('roles/{id}/confirmDelete', 'RoleController@confirmDelete')->name('roles.confirmDelete');

    Route::resource('roles', 'RoleController');

});

/*
 * TEST purposes
 */
Route::get('mail/test', function() {
    return new App\Mail\InvitationNewUserMail('aogyuaogahg', '111111b');
});

Route::get('test', function() {
    phpinfo();
});

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



// TODO: How to route without a word (edit). Possible solution->Routing without the search and ord parameters
// TODO: Preguntar: Para qué le tengo que pasar el id al update, si ya se obtienen los argumentos con Request

// TODO: Enviar mail información de cita pendiente con doctor x. Entrar en link para validar.
// Si el paciente rechaza cita el doctor y admin reciben email de paciente ha rechazado cita con motivo

/*
Route::get( 'user/recorddisplay/{id}', function ( $id) {
    fopen( resource_path( 'views/' . $id . '.blade.php' ), 'w' );
    return view($id);
});
*/