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
Route::group(['middleware' => ['setLocale']], function () {

    // Full view routes
    Route::get('/', function () {
        $user = Auth::user(); //Check for session stablished
        if($user)
            return redirect()->action('LoginController@index');
        return view('login');
    });

    // Generic login purposes routes
    Route::post('/login', 'LoginController@login');
    Route::post('/loginForgotten', 'LoginController@loginForgotten');

    // Reset password routes
    Route::get('/password/reset/{token?}', 'LoginController@forgotPassword');
    Route::post('/passwordChanged', 'LoginController@changePassword');
    Route::get('isPasswordForgotten', 'LoginController@isPasswordForgotten');

});

Route::group(['middleware' => ['isLogged','setLocale', 'checkUserRole','checkPermissionRoutes']], function () {

    Route::get('dashboard', 'LoginController@index')->name('dashboard.index');
    Route::get('setLanguage/{lang?}', 'LoginController@setLanguage');

    // Generic login purposes routes
    Route::match(array('GET', 'POST'), 'logout', 'LoginController@logout');

    // Settings and profile routes
    Route::get('settings/index/{id?}', 'SettingController@index');
    Route::post('settings/update', 'SettingController@update');
    Route::post('settings/avatar/update/{id?}', [
        'uses' => 'SettingController@updateAvatar',
        'as' => 'avatar.update'
    ]);
    Route::get('settings/avatar/confirmAvatarDelete/{id?}', 'SettingController@confirmAvatarDelete');
    Route::delete('settings/avatar/destroy/{id?}', 'SettingController@avatarDestroy');
    Route::post('settings/avatar/convert', 'SettingController@convertAvatar');

    // User creation routes
    Route::get('user/newUser', 'UsersManagementController@newUser');
    Route::post('user/create', 'UsersManagementController@create');
    Route::get('user/createUserFromMail/{token?}', 'UsersManagementController@createUserFromMail');
    Route::post('user/createNewUser', 'UsersManagementController@createNewUser');

    // User routes
    Route::get('users/{id}/confirmDelete', 'UserController@confirmDelete');
    Route::match(array('GET', 'POST'), 'users/viewDT', 'UserController@ajaxViewDatatable');
    Route::resource('users', 'UserController');

    // Patient routes
    Route::get('patients/{id}/confirmDelete', 'PatientController@confirmDelete');
    Route::match(array('GET', 'POST'), 'patients/viewDT', 'PatientController@ajaxViewDatatable');
    Route::resource('patients', 'PatientController');

    // Staff routes
    Route::get('staff/{id}/confirmDelete', 'StaffController@confirmDelete');
    Route::match(array('GET', 'POST'), 'staff/viewDT', 'StaffController@ajaxViewDatatable');
    Route::resource('staff', 'StaffController');

    // Schedule routes
    Route::match(array('GET', 'POST'), 'schedule/viewDT', 'ScheduleController@ajaxViewDatatable');
    Route::match(array('GET', 'POST'), 'schedule/generateSchedule', 'ScheduleController@generateSchedule');
    Route::patch('schedule/saveSchedule/{id?}', 'ScheduleController@saveSchedule');
    Route::get('schedule', 'ScheduleController@index');
    Route::get('schedule/staff', 'ScheduleController@getStaff');
    Route::get('schedule/staff/{id}', 'ScheduleController@showSchedule');
    Route::delete('schedule/{id}', 'ScheduleController@destroy');

    // Medical treatment routes
    Route::get('treatments/{id}/confirmDelete', 'TreatmentController@confirmDelete');
    Route::match(array('GET', 'POST'), 'treatments/viewDT', 'TreatmentController@ajaxViewDatatable');
    Route::match(array('GET', 'POST'), 'treatments/singlePatient/{id}/viewDT', 'TreatmentController@ajaxViewDatatableSP');
    Route::get('treatments/{id}/indexSinglePatient', 'TreatmentController@indexSinglePatient');
    Route::post('treatments/indexSinglePatient', 'TreatmentController@indexSinglePatient');
    Route::resource('treatments', 'TreatmentController');

    // Records routes
    Route::match(array('GET', 'POST'), 'records', 'RecordsController@index');
    Route::get('singleRecord/{id}', 'RecordsController@showRecord');
    Route::get('ownRecord', 'RecordsController@showOwnRecord');

    // Dashboard ajax tabs routes
    Route::get('dashboard/frontPage', 'DashboardController@frontPageDashboard')->name('frontPageDashboard');
    Route::get('dashboard/fillMsgTable', 'DashboardController@fillMsgTable');
    Route::get('dashboard/fillUsersTypeRoles', 'DashboardController@fillUsersTypeRoles');
    Route::get('dashboard/fillWeekAppointments', 'DashboardController@fillWeekAppointments');
    Route::get('dashboard/fillDiaryAppointments', 'DashboardController@fillDiaryAppointments');
    Route::get('dashboard/fillDelayedAppointments', 'DashboardController@fillDelayedAppointments');


    /*
    * Communication purposes routes
    */
    Route::match(array('GET', 'POST'), 'pusher/auth', 'VideoCallController@authenticatePusher');
    Route::get('messaging/myMessages', 'MessageController@showMyMessages');
    Route::get('messaging/myMessages/{id}', 'MessageController@showMessagesFromUser');

    // Messaging routes
    Route::get('messaging/icon', 'MessageController@showMessageIcon');
    Route::get('messaging/summary', 'MessageController@showMessagesSummary');
    Route::get('messaging/getMessages', 'MessageController@get');
    Route::get('messaging/getContactInfo', 'MessageController@getContactInfo');
    Route::get('messaging/updateReadMessages', 'MessageController@updateReadMessages');
    Route::get('messaging/getUserFromId', 'MessageController@getUserFromId');
    Route::get('messaging/viewMessagesFromMobile/{id}', 'MessageController@viewMessagesFromMobile');
    Route::post('messaging/send', 'MessageController@send');
    Route::delete('messaging/deleteMessageChat', 'MessageController@delete');
    Route::get('messaging', 'MessageController@showMessaging');

    // VideoCall routes
    Route::get('videoCall/getUserInfo', 'VideoCallController@getUserInfo');
    Route::match(array('GET', 'POST'), 'videoCall', 'VideoCallController@showVideoCall');
    Route::match(array('GET', 'POST'), 'videoCallContainer', 'VideoCallController@showVideoCallContainer');
    Route::get('videoRoom/{sessionRoom}', 'VideoCallController@showVideoRoom');

    // Appointments routes
    // Route::get('/appointments', 'AppointmentController@index');
    // Route::get('appointment/{id}', 'AppointmentController@edit');
    Route::get('appointment/icon', 'AppointmentController@showAppointmentIcon');
    Route::get('appointment/summary', 'AppointmentController@showAppointmentsSummary');
    Route::match(array('GET', 'POST'), 'appointment/viewDT/{appointmentType?}', 'AppointmentController@ajaxViewDatatable');
    Route::match(array('GET', 'POST'), 'appointment/{id}/confirmChecked/{checked}', 'AppointmentController@confirmChecked');
    Route::match(array('GET', 'POST'), 'appointment/{id}/confirmAccomplished/{accomplished}', 'AppointmentController@confirmAccomplished');
    Route::match(array('GET', 'POST'), 'appointment/{id}/setChecked/{checked}/{mailable?}', 'AppointmentController@setChecked');
    Route::post('appointment/{id}/setAccomplished/{accomplished}', 'AppointmentController@setChecked');
    Route::get('appointment/realDoctorSchedule', 'AppointmentController@realDoctorSchedule');
    Route::get('appointment/listPending', 'AppointmentController@listPending');
    Route::get('appointment/listAccepted', 'AppointmentController@listAccepted');
    Route::get('appointment/listRejected', 'AppointmentController@listRejected');
    Route::get('appointment/listOld', 'AppointmentController@listOld');
    Route::get('appointment/calendar', 'AppointmentController@calendar');
    Route::get('appointment/showCalendar/{id}', 'AppointmentController@showCalendar');
    Route::get('appointment/{id}/confirmDelete', 'AppointmentController@confirmDelete');
    // Route::resource('appointment/all', 'AppointmentController');
    Route::resource('appointment', 'AppointmentController');

    // SMS routes
    Route::match(array('GET', 'POST'), 'sms/send', 'SmsController@sendSms');
    // Route::get('/sms/send', 'SmsController@sendSms');
    // Route::post('/sms/send', 'SmsController@postSendSms');

    // Roles routes
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