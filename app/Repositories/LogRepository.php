<?php

namespace App\Repositories;

use App\Models\Log;
use App\Repositories\BaseRepository;

/**
 * Class LogRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:16 pm UTC
*/

class LogRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'action',
        'tool',
        'element'
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
        return Log::class;
    }
}
