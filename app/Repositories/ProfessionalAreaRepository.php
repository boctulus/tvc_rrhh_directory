<?php

namespace App\Repositories;

use App\Models\ProfessionalArea;
use App\Repositories\BaseRepository;

class ProfessionalAreaRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'professional_id',
        'area_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProfessionalArea::class;
    }
}
