<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class ClientRequestProductDownloadTypes extends Model
{
    protected $table = 'client_request_product_download_types';

    public function product()
    {
        return $this->hasOne(ClientRequestProducts::class, 'product_id', 'id');
    }
}
