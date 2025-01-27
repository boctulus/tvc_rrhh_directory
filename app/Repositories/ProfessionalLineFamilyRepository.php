<?php

namespace App\Repositories;

use App\Models\ProfessionalLineFamily;
use App\Repositories\BaseRepository;

class ProfessionalLineFamilyRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'professional_id',
        'line_family_id',
        'expertise_level'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProfessionalLineFamily::class;
    }
}
