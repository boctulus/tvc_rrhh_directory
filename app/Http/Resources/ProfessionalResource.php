<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'position_id' => $this->position_id,
            'position' => $this->position ? $this->position->name : null,
            'contact' => $this->contact,
            'email' => $this->email,
            'phone' => $this->phone,
            'phone2' => $this->phone2,
            'img_url' => $this->img_url,
            'expertise' => $this->expertise,
            'location_id' => $this->location_id,
            'location' => $this->location ? $this->location->name : null,
            'areas' => $this->areas->map(function($area) {
                return [
                    'id' => $area->id,
                    'name' => $area->name,
                    'expertise_level' => $area->pivot->expertise_level ?? null
                ];
            }),
            'certifications' => $this->professionalCertifications->map(function($pc) {
                return [
                    'id' => $pc->certification_id,
                    'name' => $pc->certification->name
                ];
            })->toArray(),
            'line_families' => $this->professionalLineFamilies->map(function($plf) {
                return [
                    'id' => $plf->line_family_id,
                    'name' => $plf->lineFamily->name
                ];
            })->toArray(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}