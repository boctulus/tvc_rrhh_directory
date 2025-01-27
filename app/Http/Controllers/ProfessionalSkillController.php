<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfessionalSkillRequest;
use App\Http\Requests\UpdateProfessionalSkillRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProfessionalSkillRepository;
use Illuminate\Http\Request;
use Flash;

class ProfessionalSkillController extends AppBaseController
{
    /** @var ProfessionalSkillRepository $professionalSkillRepository*/
    private $professionalSkillRepository;

    public function __construct(ProfessionalSkillRepository $professionalSkillRepo)
    {
        $this->professionalSkillRepository = $professionalSkillRepo;
    }

    /**
     * Display a listing of the ProfessionalSkill.
     */
    public function index(Request $request)
    {
        $professionalSkills = $this->professionalSkillRepository->paginate(10);

        return view('professional_skills.index')
            ->with('professionalSkills', $professionalSkills);
    }

    /**
     * Show the form for creating a new ProfessionalSkill.
     */
    public function create()
    {
        return view('professional_skills.create');
    }

    /**
     * Store a newly created ProfessionalSkill in storage.
     */
    public function store(CreateProfessionalSkillRequest $request)
    {
        $input = $request->all();

        $professionalSkill = $this->professionalSkillRepository->create($input);

        Flash::success('Professional Skill saved successfully.');

        return redirect(route('professional-skills.index'));
    }

    /**
     * Display the specified ProfessionalSkill.
     */
    public function show($id)
    {
        $professionalSkill = $this->professionalSkillRepository->find($id);

        if (empty($professionalSkill)) {
            Flash::error('Professional Skill not found');

            return redirect(route('professional-skills.index'));
        }

        return view('professional_skills.show')->with('professionalSkill', $professionalSkill);
    }

    /**
     * Show the form for editing the specified ProfessionalSkill.
     */
    public function edit($id)
    {
        $professionalSkill = $this->professionalSkillRepository->find($id);

        if (empty($professionalSkill)) {
            Flash::error('Professional Skill not found');

            return redirect(route('professional-skills.index'));
        }

        return view('professional_skills.edit')->with('professionalSkill', $professionalSkill);
    }

    /**
     * Update the specified ProfessionalSkill in storage.
     */
    public function update($id, UpdateProfessionalSkillRequest $request)
    {
        $professionalSkill = $this->professionalSkillRepository->find($id);

        if (empty($professionalSkill)) {
            Flash::error('Professional Skill not found');

            return redirect(route('professional-skills.index'));
        }

        $professionalSkill = $this->professionalSkillRepository->update($request->all(), $id);

        Flash::success('Professional Skill updated successfully.');

        return redirect(route('professional-skills.index'));
    }

    /**
     * Remove the specified ProfessionalSkill from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $professionalSkill = $this->professionalSkillRepository->find($id);

        if (empty($professionalSkill)) {
            Flash::error('Professional Skill not found');

            return redirect(route('professional-skills.index'));
        }

        $this->professionalSkillRepository->delete($id);

        Flash::success('Professional Skill deleted successfully.');

        return redirect(route('professional-skills.index'));
    }
}
