<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCertificationRequest;
use App\Http\Requests\UpdateCertificationRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CertificationRepository;
use Illuminate\Http\Request;
use Flash;

class CertificationController extends AppBaseController
{
    /** @var CertificationRepository $certificationRepository*/
    private $certificationRepository;

    public function __construct(CertificationRepository $certificationRepo)
    {
        $this->certificationRepository = $certificationRepo;
    }

    /**
     * Display a listing of the Certification.
     */
    public function index(Request $request)
    {
        $certifications = $this->certificationRepository->paginate(10);

        return view('certifications.index')
            ->with('certifications', $certifications);
    }

    /**
     * Show the form for creating a new Certification.
     */
    public function create()
    {
        return view('certifications.create');
    }

    /**
     * Store a newly created Certification in storage.
     */
    public function store(CreateCertificationRequest $request)
    {
        $input = $request->all();

        $certification = $this->certificationRepository->create($input);

        Flash::success('Certification saved successfully.');

        return redirect(route('certifications.index'));
    }

    /**
     * Display the specified Certification.
     */
    public function show($id)
    {
        $certification = $this->certificationRepository->find($id);

        if (empty($certification)) {
            Flash::error('Certification not found');

            return redirect(route('certifications.index'));
        }

        return view('certifications.show')->with('certification', $certification);
    }

    /**
     * Show the form for editing the specified Certification.
     */
    public function edit($id)
    {
        $certification = $this->certificationRepository->find($id);

        if (empty($certification)) {
            Flash::error('Certification not found');

            return redirect(route('certifications.index'));
        }

        return view('certifications.edit')->with('certification', $certification);
    }

    /**
     * Update the specified Certification in storage.
     */
    public function update($id, UpdateCertificationRequest $request)
    {
        $certification = $this->certificationRepository->find($id);

        if (empty($certification)) {
            Flash::error('Certification not found');

            return redirect(route('certifications.index'));
        }

        $certification = $this->certificationRepository->update($request->all(), $id);

        Flash::success('Certification updated successfully.');

        return redirect(route('certifications.index'));
    }

    /**
     * Remove the specified Certification from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $certification = $this->certificationRepository->find($id);

        if (empty($certification)) {
            Flash::error('Certification not found');

            return redirect(route('certifications.index'));
        }

        $this->certificationRepository->delete($id);

        Flash::success('Certification deleted successfully.');

        return redirect(route('certifications.index'));
    }
}
