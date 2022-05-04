<?php


namespace App\Models\Repositories\Rbac;


use App\Models\Entities\Role;

class RolesRepository
{
    public function getAll()
    {
        return Role::all();
    }

    public function create(array $validated):Role
    {
        $model = new Role();
        $model->fill($validated)->save();
        return $model;
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
        return Role::findOrFail($id);
    }
}
