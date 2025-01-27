<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCertificationAPIRequest;
use App\Http\Requests\API\UpdateCertificationAPIRequest;
use App\Models\Certification;
use App\Repositories\CertificationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CertificationAPIController
 */
class CertificationAPIController extends AppBaseController
{
    private CertificationRepository $certificationRepository;

    public function __construct(CertificationRepository $certificationRepo)
    {
        $this->certificationRepository = $certificationRepo;
    }

    /**
     * Display a listing of the Certifications.
     * GET|HEAD /certifications
     */
    public function index(Request $request): JsonResponse
    {
        $certifications = $this->certificationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($certifications->toArray(), 'Certifications retrieved successfully');
    }

    /**
     * Store a newly created Certification in storage.
     * POST /certifications
     */
    public function store(CreateCertificationAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $certification = $this->certificationRepository->create($input);

        return $this->sendResponse($certification->toArray(), 'Certification saved successfully');
    }

    /**
     * Display the specified Certification.
     * GET|HEAD /certifications/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Certification $certification */
        $certification = $this->certificationRepository->find($id);

        if (empty($certification)) {
            return $this->sendError('Certification not found');
        }

        return $this->sendResponse($certification->toArray(), 'Certification retrieved successfully');
    }

    /**
     * Update the specified Certification in storage.
     * PUT/PATCH /certifications/{id}
     */
    public function update($id, UpdateCertificationAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Certification $certification */
        $certification = $this->certificationRepository->find($id);

        if (empty($certification)) {
            return $this->sendError('Certification not found');
        }

        $certification = $this->certificationRepository->update($input, $id);

        return $this->sendResponse($certification->toArray(), 'Certification updated successfully');
    }

    /**
     * Remove the specified Certification from storage.
     * DELETE /certifications/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Certification $certification */
        $certification = $this->certificationRepository->find($id);

        if (empty($certification)) {
            return $this->sendError('Certification not found');
        }

        $certification->delete();

        return $this->sendSuccess('Certification deleted successfully');
    }
}
