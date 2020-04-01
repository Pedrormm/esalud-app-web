<?php

namespace App\Repositories;

use App\Models\RolePermission;
use App\Repositories\BaseRepository;

/**
 * Class RolePermissionRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:22 pm UTC
*/

class RolePermissionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'role_id',
        'permission_id',
        'value',
        'value_name'
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
        return RolePermission::class;
    }
}
