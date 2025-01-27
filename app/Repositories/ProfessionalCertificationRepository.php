<?php

namespace App\Repositories;

use App\Models\ProfessionalCertification;
use App\Repositories\BaseRepository;

class ProfessionalCertificationRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'professional_id',
        'certification_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProfessionalCertification::class;
    }
}
