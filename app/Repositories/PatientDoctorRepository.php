<?php

namespace App\Repositories;

use App\Models\PatientDoctor;
use App\Repositories\BaseRepository;

/**
 * Class PatientDoctorRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:20 pm UTC
*/

class PatientDoctorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id_doctor',
        'user_id_patient'
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
        return PatientDoctor::class;
    }
}
