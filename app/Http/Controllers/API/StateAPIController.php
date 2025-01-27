<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStateAPIRequest;
use App\Http\Requests\API\UpdateStateAPIRequest;
use App\Models\State;
use App\Repositories\StateRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class StateAPIController
 */
class StateAPIController extends AppBaseController
{
    private StateRepository $stateRepository;

    public function __construct(StateRepository $stateRepo)
    {
        $this->stateRepository = $stateRepo;
    }

    /**
     * Display a listing of the States.
     * GET|HEAD /states
     */
    public function index(Request $request): JsonResponse
    {
        $states = $this->stateRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($states->toArray(), 'States retrieved successfully');
    }

    /**
     * Store a newly created State in storage.
     * POST /states
     */
    public function store(CreateStateAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $state = $this->stateRepository->create($input);

        return $this->sendResponse($state->toArray(), 'State saved successfully');
    }

    /**
     * Display the specified State.
     * GET|HEAD /states/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var State $state */
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            return $this->sendError('State not found');
        }

        return $this->sendResponse($state->toArray(), 'State retrieved successfully');
    }

    /**
     * Update the specified State in storage.
     * PUT/PATCH /states/{id}
     */
    public function update($id, UpdateStateAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var State $state */
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            return $this->sendError('State not found');
        }

        $state = $this->stateRepository->update($input, $id);

        return $this->sendResponse($state->toArray(), 'State updated successfully');
    }

    /**
     * Remove the specified State from storage.
     * DELETE /states/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var State $state */
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            return $this->sendError('State not found');
        }

        $state->delete();

        return $this->sendSuccess('State deleted successfully');
    }
}
