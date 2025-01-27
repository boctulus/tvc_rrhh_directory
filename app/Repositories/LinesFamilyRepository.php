<?php

namespace App\Repositories;

use App\Models\LinesFamily;
use App\Repositories\BaseRepository;

class LinesFamilyRepository extends BaseRepository
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
        return LinesFamily::class;
    }
}
