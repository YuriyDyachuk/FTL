<?php


namespace App\Models\Services;

use App\Models\Repositories\CargoTypesRepository;

class CargoTypesService
{
    private $cargoTypesRepository;

    public function __construct(CargoTypesRepository $cargoTypesRepository)
    {
        $this->cargoTypesRepository = $cargoTypesRepository;
    }

    public function getAll()
    {
        return $this->cargoTypesRepository->getAll();
    }

    public function getList()
    {
        return $this->cargoTypesRepository->getList();
    }

    public function getFields(int $id)
    {
        return $this->cargoTypesRepository->getFields($id);
    }
}
