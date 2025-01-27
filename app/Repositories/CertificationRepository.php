<?php

namespace App\Repositories;

use App\Models\Certification;
use App\Repositories\BaseRepository;

class CertificationRepository extends BaseRepository
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
        return Certification::class;
    }
}
