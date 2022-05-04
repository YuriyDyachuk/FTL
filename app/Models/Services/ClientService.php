<?php

namespace App\Models\Services;

use App\Models\Entities\Client;
use App\Models\Repositories\ClientRepository;

class ClientService
{
    private $clientRepository;
    private $clientContactService;
    public function __construct(ClientRepository $clientRepository,
                                ClientContactService $clientContactService)
    {
        $this->clientRepository = $clientRepository;
        $this->clientContactService = $clientContactService;
    }

    public function create(array $request):Client
    {
        $client = $this->clientRepository->create($request['client']);
        $this->clientContactService->create($request['contacts'], $client->id);
        return $client;
    }

    public function update(array $request):Client
    {
        $client = $this->clientRepository->update($request['client']);
        $this->clientContactService->create($request['contacts'], $client->id);
        return $client;
    }
}
