<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * Class ClientRequestProducts
 * @package App\Models\Entities
 * @property int $id
 * @property string $name
 * @property string $weight
 * @property string $volume
 * @property int $client_request_id
 * @property ClientRequests $clientRequest
 * @property string $download_type
 * @property string $pallet_size
 * @property string $amount
 * @property Leads $lead
 * @property OrderCargo $orderCargo
 * @property int $from_warehouse_cargo
 * @property string $uid
 * @property WarehouseCargo $warehouseCargo
 * @property int $status
 * @mixin \Eloquent
 */
class ClientRequestProducts extends Model
{
    use Sortable;

    protected $table = 'client_request_products';

    protected $fillable = ['status', 'uid', 'name', 'weight', 'volume', 'client_request_id', 'download_type', 'pallet_size', 'amount', 'from_warehouse_cargo'];

    public function lead()
    {
        return $this->hasOne(Leads::class, 'id', 'lead_id');
    }

    public function clientRequest()
    {
        return $this->belongsTo(ClientRequests::class);
    }

    public function warehouseCargo()
    {
        return $this->hasOne(WarehouseCargo::class, 'uid', 'uid');
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return str_replace(' ', '', $this->weight);
    }

    /**
     * @return mixed
     */
    public function getVolume()
    {
        return str_replace(' ', '', $this->volume);
    }

}
