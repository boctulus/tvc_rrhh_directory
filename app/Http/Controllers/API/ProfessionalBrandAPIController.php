<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProfessionalBrandAPIRequest;
use App\Http\Requests\API\UpdateProfessionalBrandAPIRequest;
use App\Models\ProfessionalBrand;
use App\Repositories\ProfessionalBrandRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ProfessionalBrandAPIController
 */
class ProfessionalBrandAPIController extends AppBaseController
{
    private ProfessionalBrandRepository $professionalBrandRepository;

    public function __construct(ProfessionalBrandRepository $professionalBrandRepo)
    {
        $this->professionalBrandRepository = $professionalBrandRepo;
    }

    /**
     * Display a listing of the professional-brands.
     * GET|HEAD /professional-brands
     */
    public function index(Request $request): JsonResponse
    {
        $professionalBrands = $this->professionalBrandRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($professionalBrands->toArray(), 'Professional Brands retrieved successfully');
    }

    /**
     * Store a newly created ProfessionalBrand in storage.
     * POST /professional-brands
     */
    public function store(CreateProfessionalBrandAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $professionalBrand = $this->professionalBrandRepository->create($input);

        return $this->sendResponse($professionalBrand->toArray(), 'Professional Brand saved successfully');
    }

    /**
     * Display the specified ProfessionalBrand.
     * GET|HEAD /professional-brands/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var ProfessionalBrand $professionalBrand */
        $professionalBrand = $this->professionalBrandRepository->find($id);

        if (empty($professionalBrand)) {
            return $this->sendError('Professional Brand not found');
        }

        return $this->sendResponse($professionalBrand->toArray(), 'Professional Brand retrieved successfully');
    }

    /**
     * Update the specified ProfessionalBrand in storage.
     * PUT/PATCH /professional-brands/{id}
     */
    public function update($id, UpdateProfessionalBrandAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ProfessionalBrand $professionalBrand */
        $professionalBrand = $this->professionalBrandRepository->find($id);

        if (empty($professionalBrand)) {
            return $this->sendError('Professional Brand not found');
        }

        $professionalBrand = $this->professionalBrandRepository->update($input, $id);

        return $this->sendResponse($professionalBrand->toArray(), 'ProfessionalBrand updated successfully');
    }

    /**
     * Remove the specified ProfessionalBrand from storage.
     * DELETE /professional-brands/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var ProfessionalBrand $professionalBrand */
        $professionalBrand = $this->professionalBrandRepository->find($id);

        if (empty($professionalBrand)) {
            return $this->sendError('Professional Brand not found');
        }

        $professionalBrand->delete();

        return $this->sendSuccess('Professional Brand deleted successfully');
    }
}
