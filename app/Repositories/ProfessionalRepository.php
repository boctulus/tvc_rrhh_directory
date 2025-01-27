<?php

namespace App\Repositories;

use App\Models\Professional;
use App\Repositories\BaseRepository;

class ProfessionalRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'position_id',
        'contact',
        'email',
        'phone',
        'phone2',
        'img_url',
        'expertise',
        'location_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Professional::class;
    }
}
