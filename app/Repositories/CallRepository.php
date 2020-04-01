<?php

namespace App\Repositories;

use App\Models\Call;
use App\Repositories\BaseRepository;

/**
 * Class CallRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:15 pm UTC
*/

class CallRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id_caller',
        'user_id_receptor',
        'event'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Call::class;
    }
}
