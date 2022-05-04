<?php

namespace App\Models\Entities\Block;

use App\Models\Entities\Block;
use App\Models\Entities\Order;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $date
 * @property string $time
 * @property string $fio
 * @property string $phone
 * @property string $passport_data
 * @property string $number_and_date_of_vu_delivery
 * @property string $mark_and_number_of_car
 * @property string $trailer_num
 * @property string $created_at
 * @property string $updated_at
 * @property int $order_id
 * @property Order $order
 */
class DriverBlock extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'driver_block';

    public function getBlockTitle():string
    {
        return 'Водитель';
    }

    public function getBlockType()
    {
        return Block::DRIVER_TYPE;
    }

    public function blockTitle():string
    {
        return 'driver';
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
    protected $fillable = ['date', 'time', 'fio', 'phone', 'passport_data', 'number_and_date_of_vu_delivery', 'mark_and_number_of_car', 'trailer_num', 'created_at', 'updated_at', 'order_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
