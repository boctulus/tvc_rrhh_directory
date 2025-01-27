<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProfessionalAreaAPIRequest;
use App\Http\Requests\API\UpdateProfessionalAreaAPIRequest;
use App\Models\ProfessionalArea;
use App\Repositories\ProfessionalAreaRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ProfessionalAreaAPIController
 */
class ProfessionalAreaAPIController extends AppBaseController
{
    private ProfessionalAreaRepository $professionalAreaRepository;

    public function __construct(ProfessionalAreaRepository $professionalAreaRepo)
    {
        $this->professionalAreaRepository = $professionalAreaRepo;
    }

    /**
     * Display a listing of the ProfessionalAreas.
     * GET|HEAD /professional-areas
     */
    public function index(Request $request): JsonResponse
    {
        $professionalAreas = $this->professionalAreaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($professionalAreas->toArray(), 'Professional Areas retrieved successfully');
    }

    /**
     * Store a newly created ProfessionalArea in storage.
     * POST /professional-areas
     */
    public function store(CreateProfessionalAreaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $professionalArea = $this->professionalAreaRepository->create($input);

        return $this->sendResponse($professionalArea->toArray(), 'Professional Area saved successfully');
    }

    /**
     * Display the specified ProfessionalArea.
     * GET|HEAD /professional-areas/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var ProfessionalArea $professionalArea */
        $professionalArea = $this->professionalAreaRepository->find($id);

        if (empty($professionalArea)) {
            return $this->sendError('Professional Area not found');
        }

        return $this->sendResponse($professionalArea->toArray(), 'Professional Area retrieved successfully');
    }

    /**
     * Update the specified ProfessionalArea in storage.
     * PUT/PATCH /professional-areas/{id}
     */
    public function update($id, UpdateProfessionalAreaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ProfessionalArea $professionalArea */
        $professionalArea = $this->professionalAreaRepository->find($id);

        if (empty($professionalArea)) {
            return $this->sendError('Professional Area not found');
        }

        $professionalArea = $this->professionalAreaRepository->update($input, $id);

        return $this->sendResponse($professionalArea->toArray(), 'ProfessionalArea updated successfully');
    }

    /**
     * Remove the specified ProfessionalArea from storage.
     * DELETE /professional-areas/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var ProfessionalArea $professionalArea */
        $professionalArea = $this->professionalAreaRepository->find($id);

        if (empty($professionalArea)) {
            return $this->sendError('Professional Area not found');
        }

        $professionalArea->delete();

        return $this->sendSuccess('Professional Area deleted successfully');
    }
}
