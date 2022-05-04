<?php


namespace App\Models\Services;

use App\Models\Repositories\ClientRequestProductsRepository;

class ClientRequestProductsService
{
    private $clientRequestProductsRepository;

    public function __construct(ClientRequestProductsRepository $clientRequestProductsRepository)
    {
        $this->clientRequestProductsRepository = $clientRequestProductsRepository;
    }

    public function getAll()
    {
        return $this->clientRequestProductsRepository->getAll()->sortable()->paginate(env('ITEMS_PER_PAGE'));
    }
}
