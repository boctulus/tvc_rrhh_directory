<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AreaRepository;
use Illuminate\Http\Request;
use Flash;

class AreaController extends AppBaseController
{
    /** @var AreaRepository $areaRepository*/
    private $areaRepository;

    public function __construct(AreaRepository $areaRepo)
    {
        $this->areaRepository = $areaRepo;
    }

    /**
     * Display a listing of the Area.
     */
    public function index(Request $request)
    {
        $areas = $this->areaRepository->paginate(10);

        return view('areas.index')
            ->with('areas', $areas);
    }

    /**
     * Show the form for creating a new Area.
     */
    public function create()
    {
        return view('areas.create');
    }

    /**
     * Store a newly created Area in storage.
     */
    public function store(CreateAreaRequest $request)
    {
        $input = $request->all();

        $area = $this->areaRepository->create($input);

        Flash::success('Area saved successfully.');

        return redirect(route('areas.index'));
    }

    /**
     * Display the specified Area.
     */
    public function show($id)
    {
        $area = $this->areaRepository->find($id);

        if (empty($area)) {
            Flash::error('Area not found');

            return redirect(route('areas.index'));
        }

        return view('areas.show')->with('area', $area);
    }

    /**
     * Show the form for editing the specified Area.
     */
    public function edit($id)
    {
        $area = $this->areaRepository->find($id);

        if (empty($area)) {
            Flash::error('Area not found');

            return redirect(route('areas.index'));
        }

        return view('areas.edit')->with('area', $area);
    }

    /**
     * Update the specified Area in storage.
     */
    public function update($id, UpdateAreaRequest $request)
    {
        $area = $this->areaRepository->find($id);

        if (empty($area)) {
            Flash::error('Area not found');

            return redirect(route('areas.index'));
        }

        $area = $this->areaRepository->update($request->all(), $id);

        Flash::success('Area updated successfully.');

        return redirect(route('areas.index'));
    }

    /**
     * Remove the specified Area from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $area = $this->areaRepository->find($id);

        if (empty($area)) {
            Flash::error('Area not found');

            return redirect(route('areas.index'));
        }

        $this->areaRepository->delete($id);

        Flash::success('Area deleted successfully.');

        return redirect(route('areas.index'));
    }
}
