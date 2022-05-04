<?php

namespace App\Models\Entities\Report;

use App\Models\Entities\GettingActCargo;
use App\Models\Entities\Order;
use App\Models\Traits\OrderReport;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $order_id
 * @property string $name
 * @property string $weight
 * @property string $volume
 * @property string $download_type
 * @property string $pallet_size
 * @property string $amount
 * @property string $notes
 * @property string $created_at
 * @property string $updated_at
 * @property Order $order
 * @property int $status
 * @mixin \Eloquent
 */
class CargoReport extends Model
{
    use OrderReport;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cargo_report';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'name', 'weight', 'volume', 'download_type', 'pallet_size', 'amount', 'notes', 'created_at', 'updated_at', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getWarehouseCargos()
    {
        $res = [];
        $currentCargos = $this->order->getCurrentOrderCargo();
        if(!empty($currentCargos)){
            foreach ($currentCargos as $currentCargo) {
                $res[] = $currentCargo->clientRequestProduct->warehouseCargo()->first();
            }
        }

        return array_filter($res);
    }
}
