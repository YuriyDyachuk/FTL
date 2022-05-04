<?php


namespace App\Models\Repositories;


use App\Models\Entities\ClientRequestProducts;
use App\Models\Entities\OrderCargo;

class ClientRequestProductsRepository
{
    public function getAll()
    {
        return ClientRequestProducts::query()->with(['downloadTypes', 'lead', 'goodsOrders', 'goodsOrders.order', 'lead.client', 'clientRequest']);
    }
}
