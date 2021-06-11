<?php
use Illuminate\Support\Facades\App;

defined("HV_VERSION") or define("HV_VERSION", '0.1.00');
defined("HV_LAST_CHANGE") or define("HV_LAST_CHANGE", '20200225_0000');
defined("HV_USE_BOOTSTRAP3") or define("HV_USE_BOOTSTRAP3", false);
defined("HV_MAX_INVITATION_DAYS") or define("HV_MAX_INVITATION_DAYS", 30);
defined("HV_MAX_ITERATION_TOKEN") or define("HV_MAX_ITERATION_TOKEN", 1000);
defined("HV_DNI_LETTERS") or define("HV_DNI_LETTERS",  "trwagmyfpdxbnjzsqvhlcke");
defined("HV_DNI_CHECK") or define("HV_DNI_CHECK", true);
defined("HV_MAX_TIMES_CREATE_USER_SENT") or define("HV_MAX_TIMES_CREATE_USER_SENT", 2);
defined("HV_ROLE_ASSIGNED_WHEN_DELETED") or define("HV_ROLE_ASSIGNED_WHEN_DELETED",  "Guest");
defined("HV_APP_TITLE_NAME") or define("HV_APP_TITLE_NAME",  "MI HOSPITAL V.");
defined("HV_PAGINATION") or define("HV_PAGINATION", '10');
defined("HV_IMAGE_MAX_SIZE") or define("HV_IMAGE_MAX_SIZE", '3000000');




class HV_ROLES{
    const PATIENT = 1;
    const DOCTOR = 2;
    const HELPER = 3;
    const ADMIN = 4;
    const GUEST = 5;
}

class HV_PERMISSIONS_ACTIVATED{
    const NONE = 0;
    const ACTIVE = 1;
    // const READ = 1;
    // const READ_WRITE = 2;
    // Call to helper fillPermissionClass() to fill it
}

class HV_APPOINTMENT_CHECKS{
    const PENDING = 0;
    const ACCEPTED = 1;
    const DENIED = 2;
}
class HV_WEEKDAYS{
    const L = "Lunes";
    const M = "Martes";
    const X = "Miércoles";
    const J = "Jueves";
    const V = "Viernes";
    const S = "Sábado";
    const D = "Domingo";
}
class SHIFTS{
    const M = 'M';
    const ME = 'ME';
    const MN = 'MN';
    const MEN = 'MEN';
    const E = 'E';
    const EN = 'EN';
    const N = 'N';
    public static $types = [self::M, self::ME, self::MN, self::MEN, self::E, self::EN, self::N];
}

class HV_USER_TYPES {
    const PATIENT = 'patient';
    const STAFF = 'staff';
}

class HV_DASHBOARD_USERS_COLORS  {
    public static $COLORS =[
        'rgb(255, 99, 132)',
        'rgb(75, 192, 192)',
        'rgb(255, 205, 86)',
        'rgb(51, 51, 51)',
        'rgb(54, 162, 235)' ,
        'rgb(255, 97, 182)',
        'rgb(124, 32, 32)',
        'rgb(235, 235, 235)'
    ];
}



class IPS{
    const PUBLIC_IP_SITE = 'http://checkip.dyndns.com/';
    public static function getPrivateIp (){
        return \Request::ip();
    } 

    public static function getPublicIp (){
        $ip_address=file_get_contents(self::PUBLIC_IP_SITE);
        $ip_address = str_replace("Current IP Address: ","",$ip_address);
        $start = strpos($ip_address, '<body>') + 6;
        $end = strpos($ip_address, '</body>');
        $publicIp = substr($ip_address, $start, $end - $start);
        return $publicIp;
    } 
}


class HV_LANGUAGE{
    public static function getLang() {
        return App::currentLocale();
    }
    public static function getLangLong() {
        $lang = App::currentLocale();
        switch($lang) {
            case 'es':
                return 'Spanish';
                break;
            case 'en':
                return 'English';
                break;
            case 'it':
                return 'Italian';
                break;
            case "pt":
                return 'Portuguese';
                break;
            case "fr":
                return 'French';
                break;
            case "ro":
                return 'Romanian';
                break;
            case "de":
                return 'German';
                break;
            case "ar":
                return 'Arabic';
                break;
            case "ru":
                return 'Russian';
                break;     
            case "zh_CN":
                return 'Chinese';
                break;
            case "ja":
                return 'Japanese';
                break; 
            default:
                return null;
                break;
        }
    }
}