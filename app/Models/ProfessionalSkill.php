<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalSkill extends Model
{
    public $table = 'professional_skill';

    public $fillable = [
        'professional_id',
        'skill_id',
        'expertise_level'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'professional_id' => 'required',
        'skill_id' => 'required',
        'expertise_level' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function professional(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Professional::class, 'professional_id');
    }

    public function skill(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Skill::class, 'skill_id');
    }
}
