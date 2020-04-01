<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLogRequest;
use App\Http\Requests\UpdateLogRequest;
use App\Repositories\LogRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class LogController extends AppBaseController
{
    /** @var  LogRepository */
    private $logRepository;

    public function __construct(LogRepository $logRepo)
    {
        $this->logRepository = $logRepo;
    }

    /**
     * Display a listing of the Log.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $logs = $this->logRepository->all();

        return view('logs.index')
            ->with('logs', $logs);
    }

    /**
     * Show the form for creating a new Log.
     *
     * @return Response
     */
    public function create()
    {
        return view('logs.create');
    }

    /**
     * Store a newly created Log in storage.
     *
     * @param CreateLogRequest $request
     *
     * @return Response
     */
    public function store(CreateLogRequest $request)
    {
        $input = $request->all();

        $log = $this->logRepository->create($input);

        Flash::success('Log saved successfully.');

        return redirect(route('logs.index'));
    }

    /**
     * Display the specified Log.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $log = $this->logRepository->find($id);

        if (empty($log)) {
            Flash::error('Log not found');

            return redirect(route('logs.index'));
        }

        return view('logs.show')->with('log', $log);
    }

    /**
     * Show the form for editing the specified Log.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $log = $this->logRepository->find($id);

        if (empty($log)) {
            Flash::error('Log not found');

            return redirect(route('logs.index'));
        }

        return view('logs.edit')->with('log', $log);
    }

    /**
     * Update the specified Log in storage.
     *
     * @param int $id
     * @param UpdateLogRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLogRequest $request)
    {
        $log = $this->logRepository->find($id);

        if (empty($log)) {
            Flash::error('Log not found');

            return redirect(route('logs.index'));
        }

        $log = $this->logRepository->update($request->all(), $id);

        Flash::success('Log updated successfully.');

        return redirect(route('logs.index'));
    }

    /**
     * Remove the specified Log from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $log = $this->logRepository->find($id);

        if (empty($log)) {
            Flash::error('Log not found');

            return redirect(route('logs.index'));
        }

        $this->logRepository->delete($id);

        Flash::success('Log deleted successfully.');

        return redirect(route('logs.index'));
    }
}
