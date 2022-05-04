<?php


namespace App\Models\Repositories\Rbac;


use App\Models\Entities\Permission;

class PermissionsRepository
{
    public function getAll()
    {
        return Permission::all();
    }

    public function create(array $validated)
    {
        $model = new Permission();
        $model->fill($validated)->save();
    }

    public function delete(int $id)
    {
        $model = $this->findById($id);
        $model->delete();
    }

    public function update(int $id, array $validateData)
    {
        $model = $this->findById($id);
        $model->update($validateData);
    }

    public function findById(int $id)
    {
        return Permission::findOrFail($id);
    }
}
