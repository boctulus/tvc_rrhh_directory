<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalLineFamily extends Model
{
    public $table = 'professional_line_family';

    public $fillable = [
        'professional_id',
        'line_family_id',
        'expertise_level'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'professional_id' => 'required',
        'line_family_id' => 'required',
        'expertise_level' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function lineFamily(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\LinesFamily::class, 'line_family_id');
    }

    public function professional(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Professional::class, 'professional_id');
    }
}
