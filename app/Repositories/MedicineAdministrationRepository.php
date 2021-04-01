<?php

namespace App\Repositories;

use App\Models\MedicineAdministration;
use App\Repositories\BaseRepository;

/**
 * Class MedicineAdministrationRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:16 pm UTC
*/

class MedicineAdministrationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return MedicineAdministration::class;
    }
}
