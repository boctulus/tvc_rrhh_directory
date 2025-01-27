<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalArea extends Model
{
    public $table = 'professional_area';

    public $fillable = [
        'professional_id',
        'area_id'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'professional_id' => 'required',
        'area_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function area(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Area::class, 'area_id');
    }

    public function professional(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Professional::class, 'professional_id');
    }
}
