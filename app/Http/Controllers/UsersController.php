<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsAdmin;
use App\Http\Requests\UsersRequest;
use App\User;
use Illuminate\Http\Request;
use App\Models\Services\UsersService;
use App\Models\Services\Rbac\RolesService;

class UsersController extends Controller
{
    private $usersService;
    private $rolesService;

    public $roles;

    public function __construct(UsersService $usersService,
                                RolesService $rolesService)
    {
        $this->usersService = $usersService;
        $this->rolesService = $rolesService;
        $this->roles = $this->rolesService->getAll();
        //$this->middleware(IsAdmin::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->usersService->getAll();

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('users.create', ['roles' => $this->roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UsersRequest $request)
    {
        $user = $this->usersService->create($request);
        $this->rolesService->updateUserRoles($user, $request->input('roles'));
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->usersService->findById($id);
        return view('users.edit', ['user' => $user, 'roles' => $this->roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $validateData = $this->validate($request, [
            'name' => 'string|required',
            'email' => 'string|required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:8'
        ]);
        $user = $this->usersService->update($id, $validateData);
        $this->rolesService->updateUserRoles($user, $request->input('roles'));
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->usersService->delete($id);
        return redirect()->route('users.index');
    }
}
