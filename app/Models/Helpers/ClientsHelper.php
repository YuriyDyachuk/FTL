<?php


namespace App\Models\Helpers;


use App\Models\Entities\Client;

class ClientsHelper
{
    public static function getList()
    {
        return Client::where('name', '!=', '')->pluck('name', 'id');
    }
}
