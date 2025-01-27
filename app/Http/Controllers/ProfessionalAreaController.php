<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfessionalAreaRequest;
use App\Http\Requests\UpdateProfessionalAreaRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProfessionalAreaRepository;
use Illuminate\Http\Request;
use Flash;

class ProfessionalAreaController extends AppBaseController
{
    /** @var ProfessionalAreaRepository $professionalAreaRepository*/
    private $professionalAreaRepository;

    public function __construct(ProfessionalAreaRepository $professionalAreaRepo)
    {
        $this->professionalAreaRepository = $professionalAreaRepo;
    }

    /**
     * Display a listing of the ProfessionalArea.
     */
    public function index(Request $request)
    {
        $professionalAreas = $this->professionalAreaRepository->paginate(10);

        return view('professional_areas.index')
            ->with('professionalAreas', $professionalAreas);
    }

    /**
     * Show the form for creating a new ProfessionalArea.
     */
    public function create()
    {
        return view('professional_areas.create');
    }

    /**
     * Store a newly created ProfessionalArea in storage.
     */
    public function store(CreateProfessionalAreaRequest $request)
    {
        $input = $request->all();

        $professionalArea = $this->professionalAreaRepository->create($input);

        Flash::success('Professional Area saved successfully.');

        return redirect(route('professional-areas.index'));
    }

    /**
     * Display the specified ProfessionalArea.
     */
    public function show($id)
    {
        $professionalArea = $this->professionalAreaRepository->find($id);

        if (empty($professionalArea)) {
            Flash::error('Professional Area not found');

            return redirect(route('professional-areas.index'));
        }

        return view('professional_areas.show')->with('professionalArea', $professionalArea);
    }

    /**
     * Show the form for editing the specified ProfessionalArea.
     */
    public function edit($id)
    {
        $professionalArea = $this->professionalAreaRepository->find($id);

        if (empty($professionalArea)) {
            Flash::error('Professional Area not found');

            return redirect(route('professional-areas.index'));
        }

        return view('professional_areas.edit')->with('professionalArea', $professionalArea);
    }

    /**
     * Update the specified ProfessionalArea in storage.
     */
    public function update($id, UpdateProfessionalAreaRequest $request)
    {
        $professionalArea = $this->professionalAreaRepository->find($id);

        if (empty($professionalArea)) {
            Flash::error('Professional Area not found');

            return redirect(route('professional-areas.index'));
        }

        $professionalArea = $this->professionalAreaRepository->update($request->all(), $id);

        Flash::success('Professional Area updated successfully.');

        return redirect(route('professional-areas.index'));
    }

    /**
     * Remove the specified ProfessionalArea from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $professionalArea = $this->professionalAreaRepository->find($id);

        if (empty($professionalArea)) {
            Flash::error('Professional Area not found');

            return redirect(route('professional-areas.index'));
        }

        $this->professionalAreaRepository->delete($id);

        Flash::success('Professional Area deleted successfully.');

        return redirect(route('professional-areas.index'));
    }
}
