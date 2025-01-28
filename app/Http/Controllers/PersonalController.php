<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use App\Models\Area;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    function index() {
        // Obtener todas las áreas únicas
        $areas = Area::pluck('name')->toArray();

        // Obtener profesionales con sus relaciones
        $professionals = Professional::with([
            'position', 
            'location', 
            'professionalAreas.area',
            'professionalCertifications.certification'
        ])->get();

        // Transformar profesionales para mantener la estructura JSON
        $personal = $professionals->map(function($prof) {
            // Transformar áreas con niveles de experiencia
            $areaLevels = $prof->professionalAreas->mapWithKeys(function($pa) {
                return [$pa->area->name => $pa->expertise_level ?? 3];
            })->toArray();

            return [
                'id' => $prof->id,
                'name' => $prof->name,
                'position' => $prof->position->name,
                'brands' => $prof->professionalAreas
                    ->map(function($pa) { return $pa->area->name; })
                    ->unique()
                    ->implode(', '),
                'certifications' => $prof->professionalCertifications
                    ->map(function($pc) { return $pc->certification->name; })
                    ->implode(', '),
                'lines_families' => $areaLevels, // Mantenemos el nombre por compatibilidad
                'expertise' => $prof->expertise,
                'location' => $prof->location->name,
                'contact' => $prof->contact,
                'phone' => $prof->phone,
                'img_url' => $prof->img_url,
                'areas' => $prof->professionalAreas
                    ->map(function($pa) { return $pa->area->name; })
                    ->unique()
                    ->toArray()
            ];
        })->toArray();

        return view('personal.personal_grid', compact('areas', 'personal'));
    }
}