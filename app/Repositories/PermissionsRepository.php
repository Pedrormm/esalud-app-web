<?php

namespace App\Repositories;

use App\Models\Permissions;
use App\Repositories\BaseRepository;

/**
 * Class PermissionsRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:18 pm UTC
*/

class PermissionsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'flag_meaning',
        'default_permission',
        'permission_name'
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
        return Permissions::class;
    }
}
