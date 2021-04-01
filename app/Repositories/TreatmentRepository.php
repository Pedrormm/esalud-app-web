<?php

namespace App\Repositories;

use App\Models\Treatment;
use App\Repositories\BaseRepository;

/**
 * Class TreatmentRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:16 pm UTC
*/

class TreatmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id_patient',
        'user_id_doctor',
        'type_medicine_id',
        'medicine_administration_id',
        'description',
        'treatment_starting_date',
        'treatment_end_date'
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
        return Treatment::class;
    }
}
