<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsAdmin;
use App\Http\Requests\RolesRequest;
use App\Models\Entities\Permission;
use Illuminate\Http\Request;
use App\Models\Services\Rbac\RolesService;
use App\Models\Services\Rbac\PermissionsService;

class RolesController extends Controller
{
    private $rolesService;
    private $permissionsService;

    public function __construct(RolesService $rolesService,
                                PermissionsService $permissionsService)
    {
        $this->rolesService = $rolesService;
        $this->permissionsService = $permissionsService;
        $this->middleware(IsAdmin::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->rolesService->getAll();
        return view('roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request)
    {
        $role = $this->rolesService->create($request);
        return redirect()->route('roles.edit', ['id' => $role->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->rolesService->findById($id);
        $permissions = $this->permissionsService->getAll()->groupBy('permission_group');
        return view('roles.edit', ['role' => $role, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $validateData = $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$id,
            'display_name' => 'required|unique:roles,display_name,'.$id,
            'description' => 'nullable'
        ]);
        $this->rolesService->update($id, $validateData);
        $this->rolesService->updatePermissions($id, $request->input('permissions'));
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->rolesService->delete($id);
        return redirect()->route('roles.index');
    }
}
