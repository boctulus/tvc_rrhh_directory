<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProfessionalAPIRequest;
use App\Http\Requests\API\UpdateProfessionalAPIRequest;
use App\Models\Professional;
use App\Repositories\ProfessionalRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ProfessionalAPIController
 */
class ProfessionalAPIController extends AppBaseController
{
    private ProfessionalRepository $professionalRepository;

    public function __construct(ProfessionalRepository $professionalRepo)
    {
        $this->professionalRepository = $professionalRepo;
    }

    /**
     * Display a listing of the Professionals.
     * GET|HEAD /professionals
     */
    public function index(Request $request): JsonResponse
    {
        $professionals = $this->professionalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($professionals->toArray(), 'Professionals retrieved successfully');
    }

    /**
     * Store a newly created Professional in storage.
     * POST /professionals
     */
    public function store(CreateProfessionalAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $professional = $this->professionalRepository->create($input);

        return $this->sendResponse($professional->toArray(), 'Professional saved successfully');
    }

    /**
     * Display the specified Professional.
     * GET|HEAD /professionals/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Professional $professional */
        $professional = $this->professionalRepository->find($id);

        if (empty($professional)) {
            return $this->sendError('Professional not found');
        }

        return $this->sendResponse($professional->toArray(), 'Professional retrieved successfully');
    }

    /**
     * Update the specified Professional in storage.
     * PUT/PATCH /professionals/{id}
     */
    public function update($id, UpdateProfessionalAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Professional $professional */
        $professional = $this->professionalRepository->find($id);

        if (empty($professional)) {
            return $this->sendError('Professional not found');
        }

        $professional = $this->professionalRepository->update($input, $id);

        return $this->sendResponse($professional->toArray(), 'Professional updated successfully');
    }

    /**
     * Remove the specified Professional from storage.
     * DELETE /professionals/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Professional $professional */
        $professional = $this->professionalRepository->find($id);

        if (empty($professional)) {
            return $this->sendError('Professional not found');
        }

        $professional->delete();

        return $this->sendSuccess('Professional deleted successfully');
    }
}
