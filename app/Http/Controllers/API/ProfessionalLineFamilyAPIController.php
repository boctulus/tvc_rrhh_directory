<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProfessionalLineFamilyAPIRequest;
use App\Http\Requests\API\UpdateProfessionalLineFamilyAPIRequest;
use App\Models\ProfessionalLineFamily;
use App\Repositories\ProfessionalLineFamilyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ProfessionalLineFamilyAPIController
 */
class ProfessionalLineFamilyAPIController extends AppBaseController
{
    private ProfessionalLineFamilyRepository $professionalLineFamilyRepository;

    public function __construct(ProfessionalLineFamilyRepository $professionalLineFamilyRepo)
    {
        $this->professionalLineFamilyRepository = $professionalLineFamilyRepo;
    }

    /**
     * Display a listing of the ProfessionalLineFamilies.
     * GET|HEAD /professional-line-families
     */
    public function index(Request $request): JsonResponse
    {
        $professionalLineFamilies = $this->professionalLineFamilyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($professionalLineFamilies->toArray(), 'Professional Line Families retrieved successfully');
    }

    /**
     * Store a newly created ProfessionalLineFamily in storage.
     * POST /professional-line-families
     */
    public function store(CreateProfessionalLineFamilyAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $professionalLineFamily = $this->professionalLineFamilyRepository->create($input);

        return $this->sendResponse($professionalLineFamily->toArray(), 'Professional Line Family saved successfully');
    }

    /**
     * Display the specified ProfessionalLineFamily.
     * GET|HEAD /professional-line-families/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var ProfessionalLineFamily $professionalLineFamily */
        $professionalLineFamily = $this->professionalLineFamilyRepository->find($id);

        if (empty($professionalLineFamily)) {
            return $this->sendError('Professional Line Family not found');
        }

        return $this->sendResponse($professionalLineFamily->toArray(), 'Professional Line Family retrieved successfully');
    }

    /**
     * Update the specified ProfessionalLineFamily in storage.
     * PUT/PATCH /professional-line-families/{id}
     */
    public function update($id, UpdateProfessionalLineFamilyAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ProfessionalLineFamily $professionalLineFamily */
        $professionalLineFamily = $this->professionalLineFamilyRepository->find($id);

        if (empty($professionalLineFamily)) {
            return $this->sendError('Professional Line Family not found');
        }

        $professionalLineFamily = $this->professionalLineFamilyRepository->update($input, $id);

        return $this->sendResponse($professionalLineFamily->toArray(), 'ProfessionalLineFamily updated successfully');
    }

    /**
     * Remove the specified ProfessionalLineFamily from storage.
     * DELETE /professional-line-families/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var ProfessionalLineFamily $professionalLineFamily */
        $professionalLineFamily = $this->professionalLineFamilyRepository->find($id);

        if (empty($professionalLineFamily)) {
            return $this->sendError('Professional Line Family not found');
        }

        $professionalLineFamily->delete();

        return $this->sendSuccess('Professional Line Family deleted successfully');
    }
}
