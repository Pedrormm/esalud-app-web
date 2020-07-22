<?php
defined("HV_VERSION") or define("HV_VERSION", '0.1.00');
defined("HV_LAST_CHANGE") or define("HV_LAST_CHANGE", '20200225_0000');
defined("HV_USE_BOOTSTRAP3") or define("HV_USE_BOOTSTRAP3", false);
defined("HV_MAX_INVITATION_DAYS") or define("HV_MAX_INVITATION_DAYS", 30);
defined("HV_MAX_ITERATION_TOKEN") or define("HV_MAX_ITERATION_TOKEN", 1000);

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