<?php


namespace App\Models\Services\Rbac;

use App\Http\Requests\PermissionsRequest;
use App\Models\Repositories\Rbac\PermissionsRepository;

class PermissionsService
{
    public $permissionsRepository;

    public function __construct(PermissionsRepository $permissionsRepository)
    {
        $this->permissionsRepository = $permissionsRepository;
    }

    public function getAll()
    {
        return $this->permissionsRepository->getAll();
    }

    public function create(PermissionsRequest $request)
    {
        $this->permissionsRepository->create($request->validated());
    }

    public function findById(int $id)
    {
        return $this->permissionsRepository->findById($id);
    }

    public function update(int $id, array $validateData)
    {
        $this->permissionsRepository->update($id, $validateData);
    }

    public function delete(int $id)
    {
        $this->permissionsRepository->delete($id);
    }
}
