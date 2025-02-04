<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfessionalRequest;
use App\Http\Requests\UpdateProfessionalRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProfessionalRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class ProfessionalController extends AppBaseController
{
    /** @var ProfessionalRepository $professionalRepository*/
    private $professionalRepository;

    public function __construct(ProfessionalRepository $professionalRepo)
    {
        $this->professionalRepository = $professionalRepo;
    }

    /**
     * Display a listing of the Professional.
     */
    public function index(Request $request)
    {
        $professionals = $this->professionalRepository->paginate(10);

        return view('professionals.index')
            ->with('professionals', $professionals);
    }

    /**
     * Show the form for creating a new Professional.
     */
    public function create()
    {
        return view('professionals.create');
    }

    /**
     * Display the specified Professional.
     */
    public function show($id)
    {
        $professional = $this->professionalRepository->find($id);

        if (empty($professional)) {
            Flash::error('Professional not found');

            return redirect(route('professionals.index'));
        }

        return view('professionals.show')->with('professional', $professional);
    }

    /**
     * Show the form for editing the specified Professional.
     */
    public function edit($id)
    {
        $professional = $this->professionalRepository->find($id);

        if (empty($professional)) {
            Flash::error('Professional not found');

            return redirect(route('professionals.index'));
        }

        return view('professionals.edit')->with('professional', $professional);
    }

    /**
     * Store a newly created Professional in storage.
     */
    public function store(CreateProfessionalRequest $request)
    {
        $input = $request->all();

        // Manejar subida de imagen
        if ($request->hasFile('avatar_storage')) { // Cambiar de 'image' a 'avatar_storage'
            $path = $request->file('avatar_storage')->store('professionals', 'public');
            $input['avatar_storage'] = $path;
            $input['img_url'] = null;
        } elseif ($request->filled('img_url')) {
            $input['img_url'] = $request->img_url;
            $input['avatar_storage'] = null;
        }

        // Create the professional
        $professional = $this->professionalRepository->create($input);
        
        // Sync areas with expertise levels
        if (isset($input['areas']) && is_array($input['areas'])) {
            $areasToSync = [];
            foreach ($input['areas'] as $areaId) {
                $areasToSync[$areaId] = ['expertise_level' => 3]; // default expertise
            }
            $professional->areas()->sync($areasToSync);
        }

        // Handle line families
        if (isset($input['lines_families']) && is_array($input['lines_families'])) {
            $professional->professionalLineFamilies()->createMany(
                array_map(function($lineFamilyData) {
                    return [
                        'line_family_id' => $lineFamilyData['line_family_id'],
                        'expertise_level' => $lineFamilyData['expertise_level']
                    ];
                }, $input['lines_families'])
            );
        }

        // Handle certifications
        if (isset($input['certifications']) && is_array($input['certifications'])) {
            $professional->professionalCertifications()->createMany(
                array_map(function($certificationId) {
                    return ['certification_id' => $certificationId];
                }, $input['certifications'])
            );
        }

        Flash::success('Professional saved successfully.');

        return redirect(route('professionals.index'));
    }

    /**
     * Update the specified Professional in storage.
     */
    public function update($id, UpdateProfessionalRequest $request)
    {
        $professional = $this->professionalRepository->find($id);

        if (empty($professional)) {
            Flash::error('Professional not found');

            return redirect(route('professionals.index'));
        }

        $input = $request->all();

        /* 
            Handle image file upload 
        */

        // Manejar subida de imagen
        if ($request->hasFile('avatar_storage')) { // Cambiar de 'image' a 'avatar_storage'
            // Eliminar imagen anterior si existe
            if ($professional->avatar_storage) {
                Storage::disk('public')->delete($professional->avatar_storage);
            }
            
            $path = $request->file('avatar_storage')->store('professionals', 'public');
            $input['avatar_storage'] = $path;
            $input['img_url'] = null;
        } elseif ($request->filled('img_url')) {
            $input['img_url'] = $request->img_url;
            // Eliminar imagen almacenada si existe
            if ($professional->avatar_storage) {
                Storage::disk('public')->delete($professional->avatar_storage);
                $input['avatar_storage'] = null;
            }
        }

        // Sync areas with expertise levels
        if (isset($input['areas']) && is_array($input['areas'])) {
            $areasToSync = [];
            foreach ($input['areas'] as $areaId) {
                $areasToSync[$areaId] = ['expertise_level' => 3]; // default expertise
            }
            $professional->areas()->sync($areasToSync);
        }

        // Update the professional
        $professional = $this->professionalRepository->update($input, $id);

        // Handle line families
        $professional->professionalLineFamilies()->delete();
        if (isset($input['lines_families']) && is_array($input['lines_families'])) {
            $professional->professionalLineFamilies()->createMany(
                array_map(function($lineFamilyData) {
                    return [
                        'line_family_id' => $lineFamilyData['line_family_id'],
                        'expertise_level' => $lineFamilyData['expertise_level']
                    ];
                }, $input['lines_families'])
            );
        }

        // Handle certifications
        $professional->professionalCertifications()->delete();
        if (isset($input['certifications']) && is_array($input['certifications'])) {
            $professional->professionalCertifications()->createMany(
                array_map(function($certificationId) {
                    return ['certification_id' => $certificationId];
                }, $input['certifications'])
            );
        }

        Flash::success('Professional updated successfully.');

        return redirect(route('professionals.index'));
    }

    /**
     * Remove the specified Professional from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $professional = $this->professionalRepository->find($id);

        if (empty($professional)) {
            Flash::error('Professional not found');

            return redirect(route('professionals.index'));
        }

        $this->professionalRepository->delete($id);

        Flash::success('Professional deleted successfully.');

        return redirect(route('professionals.index'));
    }
}
