<?php

namespace App\Repositories;

use App\Models\ProfessionalBrand;
use App\Repositories\BaseRepository;

class ProfessionalBrandRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'professional_id',
        'brand_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProfessionalBrand::class;
    }
}
