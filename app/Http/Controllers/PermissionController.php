<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Repositories\PermissionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PermissionController extends AppBaseController
{
    /** @var  PermissionRepository */
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepository = $permissionRepo;
    }

    /**
     * Display a listing of the Permission.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $permission = $this->permissionRepository->all();

        return view('permission.index')
            ->with('permission', $permission);
    }

    /**
     * Show the form for creating a new Permission.
     *
     * @return Response
     */
    public function create()
    {
        return view('permission.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param CreatePermissionRequest $request
     *
     * @return Response
     */
    public function store(CreatePermissionRequest $request)
    {
        $input = $request->all();

        $permission = $this->permissionRepository->create($input);

        Flash::success(\Lang::get('messages.Permission saved successfully'));

        return redirect(route('permission.index'));
    }

    /**
     * Display the specified Permission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error(\Lang::get('messages.Permission not found'));

            return redirect(route('permission.index'));
        }

        return view('permission.show')->with('permission', $permission);
    }

    /**
     * Show the form for editing the specified Permission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error(\Lang::get('messages.Permission not found'));

            return redirect(route('permission.index'));
        }

        return view('permission.edit')->with('permission', $permission);
    }

    /**
     * Update the specified Permission in storage.
     *
     * @param int $id
     * @param UpdatePermissionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePermissionRequest $request)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error(\Lang::get('messages.Permission not found'));

            return redirect(route('permission.index'));
        }

        $permission = $this->permissionRepository->update($request->all(), $id);

        Flash::success(\Lang::get('messages.Permission updated successfully'));

        return redirect(route('permission.index'));
    }

    /**
     * Remove the specified Permission from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error(\Lang::get('messages.Permission not found'));

            return redirect(route('permission.index'));
        }

        $this->permissionRepository->delete($id);

        Flash::success(\Lang::get('messages.Permission deleted successfully'));

        return redirect(route('permission.index'));
    }
}
