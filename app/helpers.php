<?php
  use Carbon\Carbon;
    
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

    