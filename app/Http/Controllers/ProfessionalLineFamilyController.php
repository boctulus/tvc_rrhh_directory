<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfessionalLineFamilyRequest;
use App\Http\Requests\UpdateProfessionalLineFamilyRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProfessionalLineFamilyRepository;
use Illuminate\Http\Request;
use Flash;

class ProfessionalLineFamilyController extends AppBaseController
{
    /** @var ProfessionalLineFamilyRepository $professionalLineFamilyRepository*/
    private $professionalLineFamilyRepository;

    public function __construct(ProfessionalLineFamilyRepository $professionalLineFamilyRepo)
    {
        $this->professionalLineFamilyRepository = $professionalLineFamilyRepo;
    }

    /**
     * Display a listing of the ProfessionalLineFamily.
     */
    public function index(Request $request)
    {
        $professionalLineFamilies = $this->professionalLineFamilyRepository->paginate(10);

        return view('professional_line_families.index')
            ->with('professionalLineFamilies', $professionalLineFamilies);
    }

    /**
     * Show the form for creating a new ProfessionalLineFamily.
     */
    public function create()
    {
        return view('professional_line_families.create');
    }

    /**
     * Store a newly created ProfessionalLineFamily in storage.
     */
    public function store(CreateProfessionalLineFamilyRequest $request)
    {
        $input = $request->all();

        $professionalLineFamily = $this->professionalLineFamilyRepository->create($input);

        Flash::success('Professional Line Family saved successfully.');

        return redirect(route('professional-line-families.index'));
    }

    /**
     * Display the specified ProfessionalLineFamily.
     */
    public function show($id)
    {
        $professionalLineFamily = $this->professionalLineFamilyRepository->find($id);

        if (empty($professionalLineFamily)) {
            Flash::error('Professional Line Family not found');

            return redirect(route('professional-line-families.index'));
        }

        return view('professional_line_families.show')->with('professionalLineFamily', $professionalLineFamily);
    }

    /**
     * Show the form for editing the specified ProfessionalLineFamily.
     */
    public function edit($id)
    {
        $professionalLineFamily = $this->professionalLineFamilyRepository->find($id);

        if (empty($professionalLineFamily)) {
            Flash::error('Professional Line Family not found');

            return redirect(route('professional-line-families.index'));
        }

        return view('professional_line_families.edit')->with('professionalLineFamily', $professionalLineFamily);
    }

    /**
     * Update the specified ProfessionalLineFamily in storage.
     */
    public function update($id, UpdateProfessionalLineFamilyRequest $request)
    {
        $professionalLineFamily = $this->professionalLineFamilyRepository->find($id);

        if (empty($professionalLineFamily)) {
            Flash::error('Professional Line Family not found');

            return redirect(route('professional-line-families.index'));
        }

        $professionalLineFamily = $this->professionalLineFamilyRepository->update($request->all(), $id);

        Flash::success('Professional Line Family updated successfully.');

        return redirect(route('professional-line-families.index'));
    }

    /**
     * Remove the specified ProfessionalLineFamily from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $professionalLineFamily = $this->professionalLineFamilyRepository->find($id);

        if (empty($professionalLineFamily)) {
            Flash::error('Professional Line Family not found');

            return redirect(route('professional-line-families.index'));
        }

        $this->professionalLineFamilyRepository->delete($id);

        Flash::success('Professional Line Family deleted successfully.');

        return redirect(route('professional-line-families.index'));
    }
}
