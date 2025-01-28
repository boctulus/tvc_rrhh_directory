<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\Professional;

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

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
