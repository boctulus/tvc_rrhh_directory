<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProfessionalCertificationAPIRequest;
use App\Http\Requests\API\UpdateProfessionalCertificationAPIRequest;
use App\Models\ProfessionalCertification;
use App\Repositories\ProfessionalCertificationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ProfessionalCertificationAPIController
 */
class ProfessionalCertificationAPIController extends AppBaseController
{
    private ProfessionalCertificationRepository $professionalCertificationRepository;

    public function __construct(ProfessionalCertificationRepository $professionalCertificationRepo)
    {
        $this->professionalCertificationRepository = $professionalCertificationRepo;
    }

    /**
     * Display a listing of the professional-certifications.
     * GET|HEAD /professional-certifications
     */
    public function index(Request $request): JsonResponse
    {
        $professionalCertifications = $this->professionalCertificationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($professionalCertifications->toArray(), 'Professional Certifications retrieved successfully');
    }

    /**
     * Store a newly created ProfessionalCertification in storage.
     * POST /professional-certifications
     */
    public function store(CreateProfessionalCertificationAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $professionalCertification = $this->professionalCertificationRepository->create($input);

        return $this->sendResponse($professionalCertification->toArray(), 'Professional Certification saved successfully');
    }

    /**
     * Display the specified ProfessionalCertification.
     * GET|HEAD /professional-certifications/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var ProfessionalCertification $professionalCertification */
        $professionalCertification = $this->professionalCertificationRepository->find($id);

        if (empty($professionalCertification)) {
            return $this->sendError('Professional Certification not found');
        }

        return $this->sendResponse($professionalCertification->toArray(), 'Professional Certification retrieved successfully');
    }

    /**
     * Update the specified ProfessionalCertification in storage.
     * PUT/PATCH /professional-certifications/{id}
     */
    public function update($id, UpdateProfessionalCertificationAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ProfessionalCertification $professionalCertification */
        $professionalCertification = $this->professionalCertificationRepository->find($id);

        if (empty($professionalCertification)) {
            return $this->sendError('Professional Certification not found');
        }

        $professionalCertification = $this->professionalCertificationRepository->update($input, $id);

        return $this->sendResponse($professionalCertification->toArray(), 'ProfessionalCertification updated successfully');
    }

    /**
     * Remove the specified ProfessionalCertification from storage.
     * DELETE /professional-certifications/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var ProfessionalCertification $professionalCertification */
        $professionalCertification = $this->professionalCertificationRepository->find($id);

        if (empty($professionalCertification)) {
            return $this->sendError('Professional Certification not found');
        }

        $professionalCertification->delete();

        return $this->sendSuccess('Professional Certification deleted successfully');
    }
}
