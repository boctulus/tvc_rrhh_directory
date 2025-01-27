<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBrandAPIRequest;
use App\Http\Requests\API\UpdateBrandAPIRequest;
use App\Models\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class BrandAPIController
 */
class BrandAPIController extends AppBaseController
{
    private BrandRepository $brandRepository;

    public function __construct(BrandRepository $brandRepo)
    {
        $this->brandRepository = $brandRepo;
    }

    /**
     * Display a listing of the Brands.
     * GET|HEAD /brands
     */
    public function index(Request $request): JsonResponse
    {
        $brands = $this->brandRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($brands->toArray(), 'Brands retrieved successfully');
    }

    /**
     * Store a newly created Brand in storage.
     * POST /brands
     */
    public function store(CreateBrandAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $brand = $this->brandRepository->create($input);

        return $this->sendResponse($brand->toArray(), 'Brand saved successfully');
    }

    /**
     * Display the specified Brand.
     * GET|HEAD /brands/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Brand $brand */
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            return $this->sendError('Brand not found');
        }

        return $this->sendResponse($brand->toArray(), 'Brand retrieved successfully');
    }

    /**
     * Update the specified Brand in storage.
     * PUT/PATCH /brands/{id}
     */
    public function update($id, UpdateBrandAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Brand $brand */
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            return $this->sendError('Brand not found');
        }

        $brand = $this->brandRepository->update($input, $id);

        return $this->sendResponse($brand->toArray(), 'Brand updated successfully');
    }

    /**
     * Remove the specified Brand from storage.
     * DELETE /brands/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Brand $brand */
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            return $this->sendError('Brand not found');
        }

        $brand->delete();

        return $this->sendSuccess('Brand deleted successfully');
    }
}
