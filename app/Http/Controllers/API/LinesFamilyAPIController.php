<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLinesFamilyAPIRequest;
use App\Http\Requests\API\UpdateLinesFamilyAPIRequest;
use App\Models\LinesFamily;
use App\Repositories\LinesFamilyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class LinesFamilyAPIController
 */
class LinesFamilyAPIController extends AppBaseController
{
    private LinesFamilyRepository $linesFamilyRepository;

    public function __construct(LinesFamilyRepository $linesFamilyRepo)
    {
        $this->linesFamilyRepository = $linesFamilyRepo;
    }

    /**
     * Display a listing of the lines-families.
     * GET|HEAD /lines-families
     */
    public function index(Request $request): JsonResponse
    {
        $linesFamilies = $this->linesFamilyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($linesFamilies->toArray(), 'Lines Families retrieved successfully');
    }

    /**
     * Store a newly created LinesFamily in storage.
     * POST /lines-families
     */
    public function store(CreateLinesFamilyAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $linesFamily = $this->linesFamilyRepository->create($input);

        return $this->sendResponse($linesFamily->toArray(), 'Lines Family saved successfully');
    }

    /**
     * Display the specified LinesFamily.
     * GET|HEAD /lines-families/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var LinesFamily $linesFamily */
        $linesFamily = $this->linesFamilyRepository->find($id);

        if (empty($linesFamily)) {
            return $this->sendError('Lines Family not found');
        }

        return $this->sendResponse($linesFamily->toArray(), 'Lines Family retrieved successfully');
    }

    /**
     * Update the specified LinesFamily in storage.
     * PUT/PATCH /lines-families/{id}
     */
    public function update($id, UpdateLinesFamilyAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var LinesFamily $linesFamily */
        $linesFamily = $this->linesFamilyRepository->find($id);

        if (empty($linesFamily)) {
            return $this->sendError('Lines Family not found');
        }

        $linesFamily = $this->linesFamilyRepository->update($input, $id);

        return $this->sendResponse($linesFamily->toArray(), 'LinesFamily updated successfully');
    }

    /**
     * Remove the specified LinesFamily from storage.
     * DELETE /lines-families/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var LinesFamily $linesFamily */
        $linesFamily = $this->linesFamilyRepository->find($id);

        if (empty($linesFamily)) {
            return $this->sendError('Lines Family not found');
        }

        $linesFamily->delete();

        return $this->sendSuccess('Lines Family deleted successfully');
    }
}
