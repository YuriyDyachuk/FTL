<?php

namespace App\Models\Entities\Report;

use App\Models\Entities\Order;
use App\Models\Traits\OrderReport;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $order_id
 * @property string $fio
 * @property string $phone
 * @property string $passport_data
 * @property string $number_and_date_of_vu_delivery
 * @property string $mark_and_number_of_car
 * @property string $trailer_num
 * @property string $created_at
 * @property string $updated_at
 * @property Order $order
 * @property string $carrier_name
 * @property integer $carrier_inn
 * @property int $status
 */
class DriverReport extends Model
{
    use OrderReport;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'driver_report';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['carrier_name', 'carrier_inn', 'order_id', 'fio', 'phone', 'passport_data', 'number_and_date_of_vu_delivery', 'mark_and_number_of_car', 'trailer_num', 'created_at', 'updated_at', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
