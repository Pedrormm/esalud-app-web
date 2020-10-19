<?php
  use Carbon\Carbon;
  use Illuminate\Support\Facades\DB;
  use App\Models\Permissions;
  use App\Models\Role;
  use App\Models\RolePermission;
    
    function imploadValue($types){
        $strTypes = implode(",", $types);
        return $strTypes;
    }
    
    function explodeValue($types){
        $strTypes = explode(",", $types);
        return $strTypes;
    }

    function get_birthdate_from_yearstring(string $y_date){
        $CurrentDateTime = new DateTime("now");
        $CurrentDateTime->sub(new DateInterval('P'.$y_date.'Y'));
        $date = ($CurrentDateTime->format('Y-m-d'));
        return $date;
    }

    function getTimeName () {
        $time = Carbon::now()->toDateTimeString();
        $time = str_replace('-', '', $time);
        $time = str_replace(':', '', $time);
        $time = str_replace(' ', '', $time);
        return $time;
    }

    function getValueName (string $value) {
        $value_name="";
        switch($value){
            case 0:
                $value_name = 'NONE';
            break;
            case 1:
                $value_name = 'READ';
            break;
            case 2:
                $value_name = 'READ_AND_WRITE';
            break;
        }
        return $value_name;
    }


    function remove_special_char($text) {
    
            $t = $text;
    
            $specChars = array(
                ' ' => '-',    '!' => '',    '"' => '',
                '#' => '',    '$' => '',    '%' => '',
                '&amp;' => '',    '\'' => '',   '(' => '',
                ')' => '',    '*' => '',    '+' => '',
                ',' => '',    '₹' => '',    '.' => '',
                '/-' => '',    ':' => '',    ';' => '',
                '<' => '',    '=' => '',    '>' => '',
                '?' => '',    '@' => '',    '[' => '',
                '\\' => '',   ']' => '',    '^' => '',
                '_' => '',    '`' => '',    '{' => '',
                '|' => '',    '}' => '',    '~' => '',
                '-----' => '-',    '----' => '-',    '---' => '-',
                '/' => '',    '--' => '-',   '/_' => '-',   
                
            );
    
            foreach ($specChars as $k => $v) {
                $t = str_replace($k, $v, $t);
            }
    
            return $t;
    }

    function createUniqueToken(string $table, string $field, int $maxChars=16) {
        $maxIterations = HV_MAX_ITERATION_TOKEN;
        $iteration = 0;
        do {
            $newToken = str_random($maxChars);
            if($iteration>$maxIterations) {
                return false;
            }
            $iteration++;
        }while(\DB::table($table)->select($field)->where($field,'=',$newToken)->count());
        return $newToken;
    }

    function checkDni(string $dni):bool {
        if(!HV_DNI_CHECK)
            return true;
        if(!preg_match("/^[\dx-z]\d{7}[a-z]$/i", $dni)) {
            return false;
        }
        $dniCheck = strtolower($dni);
        if(!is_numeric($dni[0])) {
            $str = "xyz";
            $dniCheck[0] = strpos($str, $dni[0]);
        }
        $dniNum = (int)substr($dniCheck, 0, -1);
        $dniLetter = substr($dniCheck, -1);
        $letter = HV_DNI_LETTERS[$dniNum%23];
        return $letter == $dniLetter;
    }


    function fillRolesClass() {

        $roles = Role::select('id', 'name')->get();

        $data = $roles->mapWithKeys(function ($item) {
            return [$item['name'] => $item['id']];
        });

        return $data;
    }

    function fillPermissionClass() {

        $permissions = Permissions::select('id', 'flag_meaning')->get();

        $data = $permissions->mapWithKeys(function ($item) {
            return [$item['flag_meaning'] => $item['id']];
        });
       
        // $permissions->map(function($id, $field) {
        //     return 0;
        // });
        //HV_PERMISSIONS->{$permission->$field} = $permission->id;
        return $data;
    }

    /**
     * @author PEDRING
     * @param int permissionId (Db field: permission.id)
     */
    function getAuthValueFromPermission(string $permissionMeaning, int $userId = null){
        $permissionMeaning = strtoupper($permissionMeaning);
        $authUserRole = (is_null($userId)) ? optional(Auth::user())->role_id : $userId;
        if(is_null($authUserRole)) {
            return null;
        }
        $perm = Permissions::select('id')->whereFlagMeaning($permissionMeaning)->value("id");

        $rolePermissions = RolePermission::select('activated')->where([
            ['role_id', '=', $authUserRole],
            ['permission_id', '=', $perm],            
        ])->value("activated");

        return ($rolePermissions);
    }