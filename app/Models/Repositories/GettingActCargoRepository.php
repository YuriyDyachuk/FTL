<?php


namespace App\Models\Repositories;


use App\Models\Entities\GettingActCargo;

class GettingActCargoRepository
{
    public function getAll()
    {
        return GettingActCargo::query();
    }

    public function create(array $data):GettingActCargo
    {
        return GettingActCargo::create($data);
    }

    public function update(int $id, array $data):GettingActCargo
    {
        $model = $this->findModel($id);
        $model->update($data);

        return $model;
    }

    public function delete(int $id)
    {
        $model = $this->findModel($id);
        $model->delete();
    }

    public function getById(int $id):GettingActCargo
    {
        return $this->findModel($id);
    }

    private function findModel(int $id):GettingActCargo
    {
        return GettingActCargo::findOrFail($id);
    }
}
