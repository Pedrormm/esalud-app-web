<?php

namespace App\Repositories;

use App\Models\Reports;
use App\Repositories\BaseRepository;

/**
 * Class ReportsRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:21 pm UTC
*/

class ReportsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'event_id',
        'report',
        'absence'
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
        return Reports::class;
    }
}
