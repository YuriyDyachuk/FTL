<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsAdmin;
use App\Http\Requests\PermissionsRequest;
use App\Models\Services\Rbac\PermissionsService;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    private $permissionsService;

    public function __construct(PermissionsService $permissionsService)
    {
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
        $permissions = $this->permissionsService->getAll();
        return view('permissions.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionsRequest $request)
    {
        $this->permissionsService->create($request);
        return redirect()->route('permissions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->permissionsService->findById($id);
        return view('permissions.edit', ['permission' => $permission]);
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
            'name' => 'required|unique:permissions,name,'.$id,
            'display_name' => 'required',
            'description' => 'nullable',
            'permission_group' => 'required|integer'
        ]);
        $this->permissionsService->update($id, $validateData);
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->permissionsService->delete($id);
        return redirect()->route('permissions.index');
    }
}
