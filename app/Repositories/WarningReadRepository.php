<?php

namespace App\Repositories;

use App\Models\WarningRead;
use App\Repositories\BaseRepository;

/**
 * Class WarningReadRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:22 pm UTC
*/

class WarningReadRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'warning_id'
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
        return WarningRead::class;
    }
}
