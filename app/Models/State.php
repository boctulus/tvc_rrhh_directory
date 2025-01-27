<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $table = 'states';

    public $fillable = [
        'name',
        'abbreviation'
    ];

    protected $casts = [
        'name' => 'string',
        'abbreviation' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'abbreviation' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function professionals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Professional::class, 'location_id');
    }
}
