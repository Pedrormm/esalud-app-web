<?php
defined("HV_VERSION") or define("HV_VERSION", '0.1.00');
defined("HV_LAST_CHANGE") or define("HV_LAST_CHANGE", '20200225_0000');
defined("HV_USE_BOOTSTRAP3") or define("HV_USE_BOOTSTRAP3", false);



class HV_ROLES{
    const PERM_ADMIN = 4;

}

class HV_PERMISSIONS{
    const NONE = 0;
    const READ = 1;
    const READ_WRITE = 2;

}