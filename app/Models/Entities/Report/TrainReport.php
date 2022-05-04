<?php

namespace App\Models\Entities\Report;

use App\Models\Entities\Order;
use App\Models\Traits\OrderReport;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $order_id
 * @property boolean $is_departure
 * @property string $date
 * @property string $time
 * @property string $day_photo
 * @property string $today_station
 * @property string $rest_of_km
 * @property string $rest_of_days
 * @property string $waybill
 * @property string $other
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Order $order
 * @mixin \Eloquent
 */
class TrainReport extends Model
{
    use OrderReport;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'train_report';

    public function getBlockTitle()
    {
        return 'ЖД Отчет';
    }

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['status', 'order_id', 'is_departure', 'date', 'time', 'day_photo', 'today_station', 'rest_of_km', 'rest_of_days', 'waybill', 'other', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function isDateBetweenOrderDates():bool
    {
        return true;
    }
}
