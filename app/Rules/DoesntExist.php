<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class DoesntExist implements Rule
{
    private $tableName;
    private $column;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tableName, $column)
    {
        $this->column = $column; //not_exists:users,name
      
        $this->tableName = $tableName;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        Validator::extend('not_exists', function($attribute, $value)
        {
            return DB::table($this->tableName)
                ->where($this->column, '<>', $value)
                //->andWhere($parameters[2], '<>', $value)
                ->count()<1;
        });
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
