<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfessionalCertificationRequest;
use App\Http\Requests\UpdateProfessionalCertificationRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProfessionalCertificationRepository;
use Illuminate\Http\Request;
use Flash;

class ProfessionalCertificationController extends AppBaseController
{
    /** @var ProfessionalCertificationRepository $professionalCertificationRepository*/
    private $professionalCertificationRepository;

    public function __construct(ProfessionalCertificationRepository $professionalCertificationRepo)
    {
        $this->professionalCertificationRepository = $professionalCertificationRepo;
    }

    /**
     * Display a listing of the ProfessionalCertification.
     */
    public function index(Request $request)
    {
        $professionalCertifications = $this->professionalCertificationRepository->paginate(10);

        return view('professional_certifications.index')
            ->with('professionalCertifications', $professionalCertifications);
    }

    /**
     * Show the form for creating a new ProfessionalCertification.
     */
    public function create()
    {
        return view('professional_certifications.create');
    }

    /**
     * Store a newly created ProfessionalCertification in storage.
     */
    public function store(CreateProfessionalCertificationRequest $request)
    {
        $input = $request->all();

        $professionalCertification = $this->professionalCertificationRepository->create($input);

        Flash::success('Professional Certification saved successfully.');

        return redirect(route('professional-certifications.index'));
    }

    /**
     * Display the specified ProfessionalCertification.
     */
    public function show($id)
    {
        $professionalCertification = $this->professionalCertificationRepository->find($id);

        if (empty($professionalCertification)) {
            Flash::error('Professional Certification not found');

            return redirect(route('professional-certifications.index'));
        }

        return view('professional_certifications.show')->with('professionalCertification', $professionalCertification);
    }

    /**
     * Show the form for editing the specified ProfessionalCertification.
     */
    public function edit($id)
    {
        $professionalCertification = $this->professionalCertificationRepository->find($id);

        if (empty($professionalCertification)) {
            Flash::error('Professional Certification not found');

            return redirect(route('professional-certifications.index'));
        }

        return view('professional_certifications.edit')->with('professionalCertification', $professionalCertification);
    }

    /**
     * Update the specified ProfessionalCertification in storage.
     */
    public function update($id, UpdateProfessionalCertificationRequest $request)
    {
        $professionalCertification = $this->professionalCertificationRepository->find($id);

        if (empty($professionalCertification)) {
            Flash::error('Professional Certification not found');

            return redirect(route('professional-certifications.index'));
        }

        $professionalCertification = $this->professionalCertificationRepository->update($request->all(), $id);

        Flash::success('Professional Certification updated successfully.');

        return redirect(route('professional-certifications.index'));
    }

    /**
     * Remove the specified ProfessionalCertification from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $professionalCertification = $this->professionalCertificationRepository->find($id);

        if (empty($professionalCertification)) {
            Flash::error('Professional Certification not found');

            return redirect(route('professional-certifications.index'));
        }

        $this->professionalCertificationRepository->delete($id);

        Flash::success('Professional Certification deleted successfully.');

        return redirect(route('professional-certifications.index'));
    }
}
