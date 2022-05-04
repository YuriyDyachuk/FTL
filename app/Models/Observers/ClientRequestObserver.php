<?php


namespace App\Models\Observers;


use App\Models\Entities\ClientRequestFtlwhFrom;
use App\Models\Entities\ClientRequests;

class ClientRequestObserver
{
    public function created(ClientRequests $clientRequests)
    {
        ClientRequestFtlwhFrom::create(['client_request_id' => $clientRequests->id]);
    }
}
