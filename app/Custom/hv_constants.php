<?php
defined("HV_VERSION") or define("HV_VERSION", '0.1.00');
defined("HV_LAST_CHANGE") or define("HV_LAST_CHANGE", '20200225_0000');
defined("HV_USE_BOOTSTRAP3") or define("HV_USE_BOOTSTRAP3", false);
defined("HV_MAX_INVITATION_DAYS") or define("HV_MAX_INVITATION_DAYS", 30);
defined("HV_MAX_ITERATION_TOKEN") or define("HV_MAX_ITERATION_TOKEN", 1000);
defined("HV_DNI_LETTERS") or define("HV_DNI_LETTERS",  "trwagmyfpdxbnjzsqvhlcke");
defined("HV_DNI_CHECK") or define("HV_DNI_CHECK", true);
defined("HV_MAX_TIMES_CREATE_USER_SENT") or define("HV_MAX_TIMES_CREATE_USER_SENT", 2);


class HV_ROLES{
    const PERM_PATIENT = 1;
    const PERM_DOCTOR = 2;
    const PERM_HELPER = 3;
    const PERM_ADMIN = 4;
    const PERM_GUEST = 5;
}

class HV_PERMISSIONS{
    const NONE = 0;
    const READ = 1;
    const READ_WRITE = 2;
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
