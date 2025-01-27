<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalBrand extends Model
{
    public $table = 'professional_brand';

    public $fillable = [
        'professional_id',
        'brand_id'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'professional_id' => 'required',
        'brand_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Brand::class, 'brand_id');
    }

    public function professional(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Professional::class, 'professional_id');
    }
}
