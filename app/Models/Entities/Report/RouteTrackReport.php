<?php

namespace App\Models\Entities\Report;

use App\Models\Entities\Order;
use App\Models\Traits\OrderReport;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $order_id
 * @property string $track_photo
 * @property string $endpoint_photo
 * @property string $waybill_photo
 * @property string $created_at
 * @property string $updated_at
 * @property Order $order
 * @property int $status
 */
class RouteTrackReport extends Model
{
    use OrderReport;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'route_track_report';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'track_photo', 'endpoint_photo', 'waybill_photo', 'created_at', 'updated_at', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
