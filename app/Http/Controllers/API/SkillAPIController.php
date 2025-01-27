<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSkillAPIRequest;
use App\Http\Requests\API\UpdateSkillAPIRequest;
use App\Models\Skill;
use App\Repositories\SkillRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class SkillAPIController
 */
class SkillAPIController extends AppBaseController
{
    private SkillRepository $skillRepository;

    public function __construct(SkillRepository $skillRepo)
    {
        $this->skillRepository = $skillRepo;
    }

    /**
     * Display a listing of the Skills.
     * GET|HEAD /skills
     */
    public function index(Request $request): JsonResponse
    {
        $skills = $this->skillRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($skills->toArray(), 'Skills retrieved successfully');
    }

    /**
     * Store a newly created Skill in storage.
     * POST /skills
     */
    public function store(CreateSkillAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $skill = $this->skillRepository->create($input);

        return $this->sendResponse($skill->toArray(), 'Skill saved successfully');
    }

    /**
     * Display the specified Skill.
     * GET|HEAD /skills/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Skill $skill */
        $skill = $this->skillRepository->find($id);

        if (empty($skill)) {
            return $this->sendError('Skill not found');
        }

        return $this->sendResponse($skill->toArray(), 'Skill retrieved successfully');
    }

    /**
     * Update the specified Skill in storage.
     * PUT/PATCH /skills/{id}
     */
    public function update($id, UpdateSkillAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Skill $skill */
        $skill = $this->skillRepository->find($id);

        if (empty($skill)) {
            return $this->sendError('Skill not found');
        }

        $skill = $this->skillRepository->update($input, $id);

        return $this->sendResponse($skill->toArray(), 'Skill updated successfully');
    }

    /**
     * Remove the specified Skill from storage.
     * DELETE /skills/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Skill $skill */
        $skill = $this->skillRepository->find($id);

        if (empty($skill)) {
            return $this->sendError('Skill not found');
        }

        $skill->delete();

        return $this->sendSuccess('Skill deleted successfully');
    }
}
