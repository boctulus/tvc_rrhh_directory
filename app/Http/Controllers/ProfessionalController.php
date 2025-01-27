<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfessionalRequest;
use App\Http\Requests\UpdateProfessionalRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProfessionalRepository;
use Illuminate\Http\Request;
use Flash;

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
     * Store a newly created Professional in storage.
     */
    public function store(CreateProfessionalRequest $request)
    {
        $input = $request->all();

        // Create the professional
        $professional = $this->professionalRepository->create($input);

        // Handle line families
        if (isset($input['line_families']) && is_array($input['line_families'])) {
            $professional->professionalLineFamilies()->createMany(
                array_map(function($lineFamilyId) {
                    return ['line_family_id' => $lineFamilyId];
                }, $input['line_families'])
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

        // Note: States are already handled by location_id in the main professional record

        Flash::success('Professional saved successfully.');

        return redirect(route('professionals.index'));
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

        // Update the professional
        $professional = $this->professionalRepository->update($input, $id);

        // Handle line families
        $professional->professionalLineFamilies()->delete();
        if (isset($input['line_families']) && is_array($input['line_families'])) {
            $professional->professionalLineFamilies()->createMany(
                array_map(function($lineFamilyId) {
                    return ['line_family_id' => $lineFamilyId];
                }, $input['line_families'])
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

        // Note: States are already handled by location_id in the main professional record

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
