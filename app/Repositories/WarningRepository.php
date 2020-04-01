<?php

namespace App\Repositories;

use App\Models\Warning;
use App\Repositories\BaseRepository;

/**
 * Class WarningRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:22 pm UTC
*/

class WarningRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id_creator',
        'user_id_patient',
        'text',
        'scope'
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
        return Warning::class;
    }
}
