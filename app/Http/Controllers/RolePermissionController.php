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

    /**
     * RolePermissionController constructor.
     * @param RolePermissionRepository $rolePermissionRepo
     */
    public function __construct(RolePermissionRepository $rolePermissionRepo)
    {
        $this->rolePermissionRepository = $rolePermissionRepo;
    }

    /**
     * Displays a listing of the RolePermission.
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
     * Shows the form for creating a new RolePermission.
     *
     * @return Response
     */
    public function create()
    {
        return view('role_permissions.create');
    }

    /**
     * Stores a newly created RolePermission in storage.
     *
     * @param CreateRolePermissionRequest $request
     *
     * @return Response
     */
    public function store(CreateRolePermissionRequest $request)
    {
        $input = $request->all();

        $rolePermission = $this->rolePermissionRepository->create($input);

        Flash::success('Role permission_saved_successfully.');

        return redirect(route('rolePermissions.index'));
    }

    /**
     * Displays the specified RolePermission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rolePermission = $this->rolePermissionRepository->find($id);

        if (empty($rolePermission)) {
            Flash::error('Role permission_not_found');

            return redirect(route('rolePermissions.index'));
        }

        return view('role_permissions.show')->with('rolePermission', $rolePermission);
    }

    /**
     * Shows the form for editing the specified RolePermission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rolePermission = $this->rolePermissionRepository->find($id);

        if (empty($rolePermission)) {
            Flash::error('Role permission_not_found');

            return redirect(route('rolePermissions.index'));
        }

        return view('role_permissions.edit')->with('rolePermission', $rolePermission);
    }

    /**
     * Updates the specified RolePermission in storage.
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
            Flash::error('Role permission_not_found');

            return redirect(route('rolePermissions.index'));
        }

        $rolePermission = $this->rolePermissionRepository->update($request->all(), $id);

        Flash::success('Role permission_updated_successfully.');

        return redirect(route('rolePermissions.index'));
    }

    /**
     * Removes the specified RolePermission from storage.
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
            Flash::error('Role permission_not_found');

            return redirect(route('rolePermissions.index'));
        }

        $this->rolePermissionRepository->delete($id);

        Flash::success('Role permission_deleted_successfully.');

        return redirect(route('rolePermissions.index'));
    }
}
