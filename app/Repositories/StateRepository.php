<?php

namespace App\Repositories;

use App\Models\State;
use App\Repositories\BaseRepository;

class StateRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'abbreviation'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return State::class;
    }
}
