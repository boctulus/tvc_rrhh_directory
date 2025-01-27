<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalCertification extends Model
{
    public $table = 'professional_certification';

    public $fillable = [
        'professional_id',
        'certification_id'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'professional_id' => 'required',
        'certification_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function certification(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Certification::class, 'certification_id');
    }

    public function professional(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Professional::class, 'professional_id');
    }
}
