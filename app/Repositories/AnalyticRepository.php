<?php

namespace App\Repositories;

use App\Models\Analytic;
use App\Repositories\BaseRepository;

/**
 * Class AnalyticRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:14 pm UTC
*/

class AnalyticRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'user_id_user',
        'user_id_creator',
        'analytic_result',
        'result'
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
        return Analytic::class;
    }
}
