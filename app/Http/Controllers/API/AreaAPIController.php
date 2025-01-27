<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAreaAPIRequest;
use App\Http\Requests\API\UpdateAreaAPIRequest;
use App\Models\Area;
use App\Repositories\AreaRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class AreaAPIController
 */
class AreaAPIController extends AppBaseController
{
    private AreaRepository $areaRepository;

    public function __construct(AreaRepository $areaRepo)
    {
        $this->areaRepository = $areaRepo;
    }

    /**
     * Display a listing of the Areas.
     * GET|HEAD /areas
     */
    public function index(Request $request): JsonResponse
    {
        $areas = $this->areaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($areas->toArray(), 'Areas retrieved successfully');
    }

    /**
     * Store a newly created Area in storage.
     * POST /areas
     */
    public function store(CreateAreaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $area = $this->areaRepository->create($input);

        return $this->sendResponse($area->toArray(), 'Area saved successfully');
    }

    /**
     * Display the specified Area.
     * GET|HEAD /areas/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Area $area */
        $area = $this->areaRepository->find($id);

        if (empty($area)) {
            return $this->sendError('Area not found');
        }

        return $this->sendResponse($area->toArray(), 'Area retrieved successfully');
    }

    /**
     * Update the specified Area in storage.
     * PUT/PATCH /areas/{id}
     */
    public function update($id, UpdateAreaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Area $area */
        $area = $this->areaRepository->find($id);

        if (empty($area)) {
            return $this->sendError('Area not found');
        }

        $area = $this->areaRepository->update($input, $id);

        return $this->sendResponse($area->toArray(), 'Area updated successfully');
    }

    /**
     * Remove the specified Area from storage.
     * DELETE /areas/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Area $area */
        $area = $this->areaRepository->find($id);

        if (empty($area)) {
            return $this->sendError('Area not found');
        }

        $area->delete();

        return $this->sendSuccess('Area deleted successfully');
    }
}
