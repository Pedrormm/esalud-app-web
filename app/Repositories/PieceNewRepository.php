<?php

namespace App\Repositories;

use App\Models\PieceNew;
use App\Repositories\BaseRepository;

/**
 * Class PieceNewRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:18 pm UTC
*/

class PieceNewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'content',
        'date'
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
        return PieceNew::class;
    }
}
