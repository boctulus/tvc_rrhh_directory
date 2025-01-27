<?php

namespace App\Repositories;

use App\Models\Skill;
use App\Repositories\BaseRepository;

class SkillRepository extends BaseRepository
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
        return Skill::class;
    }
}
