<?php

namespace App\Repositories;

use App\Models\TypeMedicine;
use App\Repositories\BaseRepository;

/**
 * Class TypeMedicineRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:16 pm UTC
*/

class TypeMedicineRepository extends BaseRepository
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
        return TypeMedicine::class;
    }
}
