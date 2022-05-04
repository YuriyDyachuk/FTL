<?php

namespace App\Models\Entities\Report;

use App\Models\Entities\Order;
use App\Models\Traits\OrderReport;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $order_id
 * @property string $photo
 * @property string $created_at
 * @property string $updated_at
 * @property Order $order
 * @property int $status
 */
class WaybillReport extends Model
{
    use OrderReport;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'waybill_report';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'photo', 'created_at', 'updated_at', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
