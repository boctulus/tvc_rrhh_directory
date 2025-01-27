<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfessionalBrandRequest;
use App\Http\Requests\UpdateProfessionalBrandRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProfessionalBrandRepository;
use Illuminate\Http\Request;
use Flash;

class ProfessionalBrandController extends AppBaseController
{
    /** @var ProfessionalBrandRepository $professionalBrandRepository*/
    private $professionalBrandRepository;

    public function __construct(ProfessionalBrandRepository $professionalBrandRepo)
    {
        $this->professionalBrandRepository = $professionalBrandRepo;
    }

    /**
     * Display a listing of the ProfessionalBrand.
     */
    public function index(Request $request)
    {
        $professionalBrands = $this->professionalBrandRepository->paginate(10);

        return view('professional_brands.index')
            ->with('professionalBrands', $professionalBrands);
    }

    /**
     * Show the form for creating a new ProfessionalBrand.
     */
    public function create()
    {
        return view('professional_brands.create');
    }

    /**
     * Store a newly created ProfessionalBrand in storage.
     */
    public function store(CreateProfessionalBrandRequest $request)
    {
        $input = $request->all();

        $professionalBrand = $this->professionalBrandRepository->create($input);

        Flash::success('Professional Brand saved successfully.');

        return redirect(route('professional-brands.index'));
    }

    /**
     * Display the specified ProfessionalBrand.
     */
    public function show($id)
    {
        $professionalBrand = $this->professionalBrandRepository->find($id);

        if (empty($professionalBrand)) {
            Flash::error('Professional Brand not found');

            return redirect(route('professional-brands.index'));
        }

        return view('professional_brands.show')->with('professionalBrand', $professionalBrand);
    }

    /**
     * Show the form for editing the specified ProfessionalBrand.
     */
    public function edit($id)
    {
        $professionalBrand = $this->professionalBrandRepository->find($id);

        if (empty($professionalBrand)) {
            Flash::error('Professional Brand not found');

            return redirect(route('professional-brands.index'));
        }

        return view('professional_brands.edit')->with('professionalBrand', $professionalBrand);
    }

    /**
     * Update the specified ProfessionalBrand in storage.
     */
    public function update($id, UpdateProfessionalBrandRequest $request)
    {
        $professionalBrand = $this->professionalBrandRepository->find($id);

        if (empty($professionalBrand)) {
            Flash::error('Professional Brand not found');

            return redirect(route('professional-brands.index'));
        }

        $professionalBrand = $this->professionalBrandRepository->update($request->all(), $id);

        Flash::success('Professional Brand updated successfully.');

        return redirect(route('professional-brands.index'));
    }

    /**
     * Remove the specified ProfessionalBrand from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $professionalBrand = $this->professionalBrandRepository->find($id);

        if (empty($professionalBrand)) {
            Flash::error('Professional Brand not found');

            return redirect(route('professional-brands.index'));
        }

        $this->professionalBrandRepository->delete($id);

        Flash::success('Professional Brand deleted successfully.');

        return redirect(route('professional-brands.index'));
    }
}
