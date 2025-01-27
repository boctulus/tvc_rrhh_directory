<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\StateRepository;
use Illuminate\Http\Request;
use Flash;

class StateController extends AppBaseController
{
    /** @var StateRepository $stateRepository*/
    private $stateRepository;

    public function __construct(StateRepository $stateRepo)
    {
        $this->stateRepository = $stateRepo;
    }

    /**
     * Display a listing of the State.
     */
    public function index(Request $request)
    {
        $states = $this->stateRepository->paginate(10);

        return view('states.index')
            ->with('states', $states);
    }

    /**
     * Show the form for creating a new State.
     */
    public function create()
    {
        return view('states.create');
    }

    /**
     * Store a newly created State in storage.
     */
    public function store(CreateStateRequest $request)
    {
        $input = $request->all();

        $state = $this->stateRepository->create($input);

        Flash::success('State saved successfully.');

        return redirect(route('states.index'));
    }

    /**
     * Display the specified State.
     */
    public function show($id)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error('State not found');

            return redirect(route('states.index'));
        }

        return view('states.show')->with('state', $state);
    }

    /**
     * Show the form for editing the specified State.
     */
    public function edit($id)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error('State not found');

            return redirect(route('states.index'));
        }

        return view('states.edit')->with('state', $state);
    }

    /**
     * Update the specified State in storage.
     */
    public function update($id, UpdateStateRequest $request)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error('State not found');

            return redirect(route('states.index'));
        }

        $state = $this->stateRepository->update($request->all(), $id);

        Flash::success('State updated successfully.');

        return redirect(route('states.index'));
    }

    /**
     * Remove the specified State from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error('State not found');

            return redirect(route('states.index'));
        }

        $this->stateRepository->delete($id);

        Flash::success('State deleted successfully.');

        return redirect(route('states.index'));
    }
}
