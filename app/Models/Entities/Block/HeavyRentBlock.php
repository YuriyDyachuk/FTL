<?php

namespace App\Models\Entities\Block;

use App\Models\Entities\Block;
use App\Models\Entities\Order;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $address
 * @property string $fio
 * @property string $phone
 * @property string $place_weight
 * @property string $place_size
 * @property string $cargo_photo
 * @property string $created_at
 * @property string $updated_at
 * @property string $begin_date
 * @property string $begin_time
 * @property string $begin_time_from
 * @property string $begin_time_to
 * @property int $begin_time_interval
 * @property string $end_date
 * @property string $end_time
 * @property string $end_time_from
 * @property string $end_time_to
 * @property int $end_time_interval
 * @property int $order_id
 * @property Order $order
 */
class HeavyRentBlock extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'heavy_rent_block';

    public function getBlockTitle():string
    {
        return 'Заказ тяж. техники';
    }

    public function getBlockType()
    {
        return Block::HEAVY_RENT_TYPE;
    }

    public function blockTitle():string
    {
        return 'heavyRent';
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
    protected $fillable = ['begin_date', 'begin_time', 'begin_time_from', 'begin_time_to', 'begin_time_interval',
        'end_date', 'end_time', 'end_time_from', 'end_time_to', 'end_time_interval',
        'address', 'fio', 'phone', 'place_weight', 'place_size', 'cargo_photo', 'created_at', 'updated_at', 'order_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
