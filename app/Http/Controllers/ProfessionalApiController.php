<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfessionalResource;
use App\Repositories\ProfessionalRepository;
use Illuminate\Http\Request;
use App\Models\Professional;

class ProfessionalApiController extends Controller
{
    private $professionalRepository;

    public function __construct(ProfessionalRepository $professionalRepo)
    {
        $this->professionalRepository = $professionalRepo;
    }

    public function index(Request $request)
    {
        // Use Eloquent instead of repository to ensure eager loading
        $professionals = Professional::with([
            'position', 
            'location', 
            'professionalCertifications.certification', 
            'professionalLineFamilies.lineFamily'
        ])->paginate(10);
        
        return ProfessionalResource::collection($professionals);
    }

    public function show($id)
    {
        // Use Eloquent instead of repository to ensure eager loading
        $professional = Professional::with([
            'position', 
            'location', 
            'professionalCertifications.certification', 
            'professionalLineFamilies.lineFamily'
        ])->findOrFail($id);

        return new ProfessionalResource($professional);
    }
}