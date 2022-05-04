<?php

namespace App\Models\Services;

use App\Models\Repositories\ClientContactRepository;

class ClientContactService
{
    private $clientContactRepository;
    public function __construct(ClientContactRepository $clientContactRepository)
    {
        $this->clientContactRepository = $clientContactRepository;
    }

    public function create(array $contactsRequest, int $clientId):void
    {
        $this->clientContactRepository->removeAllByClientId($clientId);
        $this->clientContactRepository->create($contactsRequest, $clientId);
    }
}
