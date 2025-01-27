<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProfessionalSkillAPIRequest;
use App\Http\Requests\API\UpdateProfessionalSkillAPIRequest;
use App\Models\ProfessionalSkill;
use App\Repositories\ProfessionalSkillRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ProfessionalSkillAPIController
 */
class ProfessionalSkillAPIController extends AppBaseController
{
    private ProfessionalSkillRepository $professionalSkillRepository;

    public function __construct(ProfessionalSkillRepository $professionalSkillRepo)
    {
        $this->professionalSkillRepository = $professionalSkillRepo;
    }

    /**
     * Display a listing of the ProfessionalSkills.
     * GET|HEAD /professional-skills
     */
    public function index(Request $request): JsonResponse
    {
        $professionalSkills = $this->professionalSkillRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($professionalSkills->toArray(), 'Professional Skills retrieved successfully');
    }

    /**
     * Store a newly created ProfessionalSkill in storage.
     * POST /professional-skills
     */
    public function store(CreateProfessionalSkillAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $professionalSkill = $this->professionalSkillRepository->create($input);

        return $this->sendResponse($professionalSkill->toArray(), 'Professional Skill saved successfully');
    }

    /**
     * Display the specified ProfessionalSkill.
     * GET|HEAD /professional-skills/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var ProfessionalSkill $professionalSkill */
        $professionalSkill = $this->professionalSkillRepository->find($id);

        if (empty($professionalSkill)) {
            return $this->sendError('Professional Skill not found');
        }

        return $this->sendResponse($professionalSkill->toArray(), 'Professional Skill retrieved successfully');
    }

    /**
     * Update the specified ProfessionalSkill in storage.
     * PUT/PATCH /professional-skills/{id}
     */
    public function update($id, UpdateProfessionalSkillAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ProfessionalSkill $professionalSkill */
        $professionalSkill = $this->professionalSkillRepository->find($id);

        if (empty($professionalSkill)) {
            return $this->sendError('Professional Skill not found');
        }

        $professionalSkill = $this->professionalSkillRepository->update($input, $id);

        return $this->sendResponse($professionalSkill->toArray(), 'ProfessionalSkill updated successfully');
    }

    /**
     * Remove the specified ProfessionalSkill from storage.
     * DELETE /professional-skills/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var ProfessionalSkill $professionalSkill */
        $professionalSkill = $this->professionalSkillRepository->find($id);

        if (empty($professionalSkill)) {
            return $this->sendError('Professional Skill not found');
        }

        $professionalSkill->delete();

        return $this->sendSuccess('Professional Skill deleted successfully');
    }
}
