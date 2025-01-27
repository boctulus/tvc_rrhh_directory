<?php

namespace App\Repositories;

use App\Models\ProfessionalSkill;
use App\Repositories\BaseRepository;

class ProfessionalSkillRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'professional_id',
        'skill_id',
        'expertise_level'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProfessionalSkill::class;
    }
}
