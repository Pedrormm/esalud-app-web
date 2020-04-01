<?php

namespace App\Repositories;

use App\Models\Protocol;
use App\Repositories\BaseRepository;

/**
 * Class ProtocolRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:19 pm UTC
*/

class ProtocolRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id_creator',
        'user_id_user',
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
        return Protocol::class;
    }
}
