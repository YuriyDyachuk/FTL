<?php


namespace App\Models\Services;

use App\Models\Entities\GettingActCargo;
use App\Models\Repositories\GettingActCargoRepository;

class GettingActCargoService
{
    private $gettingActCargoRepository;

    public function __construct(GettingActCargoRepository $gettingActCargoRepository)
    {
        $this->gettingActCargoRepository = $gettingActCargoRepository;
    }

    public function getAll()
    {
        return $this->gettingActCargoRepository->getAll()->sortable(['gettingAct.date' => 'desc'])->paginate(env('ITEMS_PER_PAGE'));
    }

    public function create(array $data)
    {
        return $this->gettingActCargoRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->gettingActCargoRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        $this->gettingActCargoRepository->delete($id);
    }

    public function getById(int $id):GettingActCargo
    {
        return $this->gettingActCargoRepository->getById($id);
    }

}
