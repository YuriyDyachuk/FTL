<?php


namespace App\Models\Services\Rbac;

use App\Http\Requests\RolesRequest;
use App\Models\Entities\Role;
use App\Models\Repositories\Rbac\RolesRepository;
use App\User;

class RolesService
{
    public $rolesRepository;

    public function __construct(RolesRepository $rolesRepository)
    {
        $this->rolesRepository = $rolesRepository;
    }

    public function getAll()
    {
        return $this->rolesRepository->getAll();
    }

    public function create(RolesRequest $request):Role
    {
        return $this->rolesRepository->create($request->validated());
    }

    public function findById(int $id):Role
    {
        return $this->rolesRepository->findById($id);
    }

    public function update(int $id, array $validateData)
    {
        $this->rolesRepository->update($id, $validateData);
    }

    public function delete(int $id)
    {
        $this->rolesRepository->delete($id);
    }

    public function updatePermissions(int $id, ?array $permissions)
    {
        $role = $this->findById($id);
        $role->detachPermissions();
        if(!blank($permissions)){
            $role->attachPermissions($permissions);
        }
    }

    public function updateUserRoles(User $user, ?array $roles)
    {
        $user->detachRoles();
        if(!blank($roles)){
            $user->attachRoles($roles);
        }
    }
}
