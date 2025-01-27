<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinesFamily extends Model
{
    public $table = 'lines_families';

    public $fillable = [
        'name'
    ];

    protected $casts = [
        'name' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function professionalLineFamilies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ProfessionalLineFamily::class, 'line_family_id');
    }
}
