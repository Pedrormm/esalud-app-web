<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRolePermissionRequest;
use App\Http\Requests\UpdateRolePermissionRequest;
use App\Repositories\RolePermissionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class RolePermissionController extends AppBaseController
{
    /** @var  RolePermissionRepository */
    private $rolePermissionRepository;

    public function __construct(RolePermissionRepository $rolePermissionRepo)
    {
        $this->rolePermissionRepository = $rolePermissionRepo;
    }

    /**
     * Display a listing of the RolePermission.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $rolePermissions = $this->rolePermissionRepository->all();

        return view('role_permissions.index')
            ->with('rolePermissions', $rolePermissions);
    }

    /**
     * Show the form for creating a new RolePermission.
     *
     * @return Response
     */
    public function create()
    {
        return view('role_permissions.create');
    }

    /**
     * Store a newly created RolePermission in storage.
     *
     * @param CreateRolePermissionRequest $request
     *
     * @return Response
     */
    public function store(CreateRolePermissionRequest $request)
    {
        $input = $request->all();

        $rolePermission = $this->rolePermissionRepository->create($input);

        Flash::success('Role Permission saved successfully.');

        return redirect(route('rolePermissions.index'));
    }

    /**
     * Display the specified RolePermission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rolePermission = $this->rolePermissionRepository->find($id);

        if (empty($rolePermission)) {
            Flash::error('Role Permission not found');

            return redirect(route('rolePermissions.index'));
        }

        return view('role_permissions.show')->with('rolePermission', $rolePermission);
    }

    /**
     * Show the form for editing the specified RolePermission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rolePermission = $this->rolePermissionRepository->find($id);

        if (empty($rolePermission)) {
            Flash::error('Role Permission not found');

            return redirect(route('rolePermissions.index'));
        }

        return view('role_permissions.edit')->with('rolePermission', $rolePermission);
    }

    /**
     * Update the specified RolePermission in storage.
     *
     * @param int $id
     * @param UpdateRolePermissionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRolePermissionRequest $request)
    {
        $rolePermission = $this->rolePermissionRepository->find($id);

        if (empty($rolePermission)) {
            Flash::error('Role Permission not found');

            return redirect(route('rolePermissions.index'));
        }

        $rolePermission = $this->rolePermissionRepository->update($request->all(), $id);

        Flash::success('Role Permission updated successfully.');

        return redirect(route('rolePermissions.index'));
    }

    /**
     * Remove the specified RolePermission from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rolePermission = $this->rolePermissionRepository->find($id);

        if (empty($rolePermission)) {
            Flash::error('Role Permission not found');

            return redirect(route('rolePermissions.index'));
        }

        $this->rolePermissionRepository->delete($id);

        Flash::success('Role Permission deleted successfully.');

        return redirect(route('rolePermissions.index'));
    }
}
