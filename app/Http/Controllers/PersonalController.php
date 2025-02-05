<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use App\Models\Area;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

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
            // $areaLevels = $prof->professionalAreas->mapWithKeys(function($pa) {
            //     return [$pa->area->name => $pa->expertise_level ?? 3];
            // })->toArray();

            $lineFamilies = $prof->professionalLineFamilies->map(function($plf) {
                return [
                    'id' => $plf->line_family_id,
                    'name' => $plf->lineFamily->name,
                    'expertise_level' => $plf->expertise_level
                ];
            });

            $lineFamily_names = $lineFamilies->pluck('name')->toArray();

            $brands = array_unique(
                array_map(function($name) {
                    if (strpos($name, '_') === false) {
                        return $name;
                    }
                    return substr($name, 0, strpos($name, '_'));
                }, $lineFamily_names)
            );
            

            return [
                'id' => $prof->id,
                'name' => $prof->name,
                'position' => $prof->position->name,
                'brands' => $brands,
                'certifications' => $prof->professionalCertifications
                    ->map(function($pc) { return $pc->certification->name; })
                    ->implode(', '),
                'lines_families' => $lineFamilies, 
                'expertise' => $prof->expertise,
                'location' => $prof->location->name ?? 'N/A',
                'contact' => $prof->contact,
                'email' => $prof->email,
                'phone' => $prof->phone,
                'img_url' => $prof->img_url,
                'avatar_storage' => $prof->avatar_storage,
                'areas' => $prof->professionalAreas
                    ->map(function($pa) { return $pa->area->name; })
                    ->unique()
                    ->toArray()
            ];
        })->toArray();

        // dd($personal[0]['lines_families']); exit;

        return view('personal.personal_grid', compact('areas', 'personal'));
    }
}