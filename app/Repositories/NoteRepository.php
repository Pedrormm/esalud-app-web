<?php

namespace App\Repositories;

use App\Models\Note;
use App\Repositories\BaseRepository;

/**
 * Class NoteRepository
 * @package App\Repositories
 * @version April 1, 2020, 8:17 pm UTC
*/

class NoteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'text',
        'event',
        'visible'
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
        return Note::class;
    }
}
