<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalArea extends Model
{
    protected $table = 'professional_areas';

    protected $fillable = [
        'professional_id', 
        'area_id', 
        'expertise_level'
    ];

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}