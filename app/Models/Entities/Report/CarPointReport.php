<?php

namespace App\Models\Entities\Report;

use App\Models\Entities\Order;
use App\Models\Traits\OrderReport;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $order_id
 * @property int $step
 * @property string $date
 * @property string $time
 * @property string $photo
 * @property string $created_at
 * @property string $updated_at
 * @property Order $order
 * @property int $status
 */
class CarPointReport extends Model
{
    use OrderReport;

//    const FIRST_POINT_TYPE = 1;
//    const LAST_POINT_TYPE = 2;
//
//    public static function typeLabels()
//    {
//        return [
//            self::FIRST_POINT_TYPE => 'Погрузка',
//            self::LAST_POINT_TYPE => 'Выгрузка',
//        ];
//    }
//
//    public static function photoFieldLabels()
//    {
//        return [
//            self::FIRST_POINT_TYPE => 'Фото на Погрузке',
//            self::LAST_POINT_TYPE => 'Фото на Выгрузке'
//        ];
//    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'car_point_report';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'step', 'date', 'time', 'photo', 'created_at', 'updated_at', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
