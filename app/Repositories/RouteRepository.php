<?php

namespace App\Repositories;

use App\Models\Route;
use App\Repositories\BaseRepository;

/**
 * Class RouteRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:16 pm UTC
*/

class RouteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'permission_id',
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
        return Route::class;
    }
}
