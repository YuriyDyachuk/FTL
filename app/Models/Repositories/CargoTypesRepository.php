<?php


namespace App\Models\Repositories;


use App\Models\Entities\CargoTypes;

class CargoTypesRepository
{
    public function getAll()
    {
        return CargoTypes::all();
    }

    public function getList()
    {
        return $this->getAll()->pluck('name', 'id');
    }

    public function getFields(int $id)
    {
        return CargoTypes::where('id', $id)->get()->toArray();
    }
}
