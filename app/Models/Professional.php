<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    public $table = 'professionals';

    public $fillable = [
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

    protected $casts = [
        'name' => 'string',
        'contact' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'phone2' => 'string',
        'img_url' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'position_id' => 'required',
        'contact' => 'required|string|max:255',
        'email' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:255',
        'phone2' => 'nullable|string|max:255',
        'img_url' => 'nullable|string|max:255',
        'expertise' => 'nullable',
        'location_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        // Add validation for related entities
        'line_families' => 'nullable|array',
        'line_families.*.line_family_id' => 'exists:line_families,id',
        'certifications' => 'nullable|array',
        'certifications.*.certification_id' => 'exists:certifications,id',
        'states' => 'nullable|array',
        'states.*.state_id' => 'exists:states,id'
    ];

    public function location(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\State::class, 'location_id');
    }

    public function position(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Position::class, 'position_id');
    }

    public function professionalAreas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ProfessionalArea::class, 'professional_id');
    }

    public function professionalBrands(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ProfessionalBrand::class, 'professional_id');
    }

    public function professionalBrand1s(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ProfessionalBrand::class, 'professional_id');
    }

    public function professionalCertifications(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ProfessionalCertification::class, 'professional_id');
    }

    public function professionalLineFamilies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ProfessionalLineFamily::class, 'professional_id');
    }

    public function professionalSkills(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ProfessionalSkill::class, 'professional_id');
    }
}
