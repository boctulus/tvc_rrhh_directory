<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLinesFamilyRequest;
use App\Http\Requests\UpdateLinesFamilyRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\LinesFamilyRepository;
use Illuminate\Http\Request;
use Flash;

class LinesFamilyController extends AppBaseController
{
    /** @var LinesFamilyRepository $linesFamilyRepository*/
    private $linesFamilyRepository;

    public function __construct(LinesFamilyRepository $linesFamilyRepo)
    {
        $this->linesFamilyRepository = $linesFamilyRepo;
    }

    /**
     * Display a listing of the LinesFamily.
     */
    public function index(Request $request)
    {
        $linesFamilies = $this->linesFamilyRepository->paginate(10);

        return view('lines_families.index')
            ->with('linesFamilies', $linesFamilies);
    }

    /**
     * Show the form for creating a new LinesFamily.
     */
    public function create()
    {
        return view('lines_families.create');
    }

    /**
     * Store a newly created LinesFamily in storage.
     */
    public function store(CreateLinesFamilyRequest $request)
    {
        $input = $request->all();

        $linesFamily = $this->linesFamilyRepository->create($input);

        Flash::success('Lines Family saved successfully.');

        return redirect(route('lines-families.index'));
    }

    /**
     * Display the specified LinesFamily.
     */
    public function show($id)
    {
        $linesFamily = $this->linesFamilyRepository->find($id);

        if (empty($linesFamily)) {
            Flash::error('Lines Family not found');

            return redirect(route('lines-families.index'));
        }

        return view('lines_families.show')->with('linesFamily', $linesFamily);
    }

    /**
     * Show the form for editing the specified LinesFamily.
     */
    public function edit($id)
    {
        $linesFamily = $this->linesFamilyRepository->find($id);

        if (empty($linesFamily)) {
            Flash::error('Lines Family not found');

            return redirect(route('lines-families.index'));
        }

        return view('lines_families.edit')->with('linesFamily', $linesFamily);
    }

    /**
     * Update the specified LinesFamily in storage.
     */
    public function update($id, UpdateLinesFamilyRequest $request)
    {
        $linesFamily = $this->linesFamilyRepository->find($id);

        if (empty($linesFamily)) {
            Flash::error('Lines Family not found');

            return redirect(route('lines-families.index'));
        }

        $linesFamily = $this->linesFamilyRepository->update($request->all(), $id);

        Flash::success('Lines Family updated successfully.');

        return redirect(route('lines-families.index'));
    }

    /**
     * Remove the specified LinesFamily from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $linesFamily = $this->linesFamilyRepository->find($id);

        if (empty($linesFamily)) {
            Flash::error('Lines Family not found');

            return redirect(route('lines-families.index'));
        }

        $this->linesFamilyRepository->delete($id);

        Flash::success('Lines Family deleted successfully.');

        return redirect(route('lines-families.index'));
    }
}
