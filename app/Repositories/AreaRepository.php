<?php

namespace App\Repositories;

use App\Models\Area;
use App\Repositories\BaseRepository;

class AreaRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Area::class;
    }
}
