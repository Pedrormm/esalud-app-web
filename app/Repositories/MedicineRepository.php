<?php

namespace App\Repositories;

use App\Models\Medicine;
use App\Repositories\BaseRepository;

/**
 * Class MedicineRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:16 pm UTC
*/

class MedicineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id_patient',
        'user_id_doctor',
        'medicine',
        'interval',
        'stop',
        'stop_user'
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
        return Medicine::class;
    }
}
