<?php

namespace App\Repositories;

use App\Models\Staff;
use App\Repositories\BaseRepository;

/**
 * Class StaffRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:11 pm UTC
*/

class StaffRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'historic',
        'user_id',
        'medical_speciality_id',
        'shift',
        'office',
        'room',
        'h_phone'
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
        return Staff::class;
    }
}
