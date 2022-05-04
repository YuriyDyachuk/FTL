<?php


namespace App\Models\Services;

use App\Models\Entities\GettingAct;
use App\Models\Repositories\GettingActRepository;

class GettingActService
{
    private $gettingActRepository;

    public function __construct(GettingActRepository $gettingActRepository)
    {
        $this->gettingActRepository = $gettingActRepository;
    }

    public function getAll()
    {
        return $this->gettingActRepository->getAll()->sortable()->paginate(env('ITEMS_PER_PAGE'));
    }

    public function create(array $data):GettingAct
    {
        return $this->gettingActRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->gettingActRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        $this->gettingActRepository->delete($id);
    }

    public function getById(int $id):GettingAct
    {
        return $this->gettingActRepository->getById($id);
    }
}
