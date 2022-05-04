<?php

namespace App\Models\Entities\Pivot;

use App\Models\Entities\Goods;
use App\Models\Entities\Leads;
use App\Models\Entities\Order;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $order_id
 * @property integer $goods_id
 * @property string $created_at
 * @property string $updated_at
 * @property Goods $good
 * @property Order $order
 * @property Leads $lead
 * @property int $order_name
 * @property int $lead_id
 * @property int $order_type
 * @mixin \Eloquent
 */
class GoodsOrders extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['order_id', 'goods_id', 'created_at', 'updated_at', 'order_name', 'lead_id', 'order_type'];

    public function goods()
    {
        return $this->belongsTo(Goods::class, 'goods_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function lead()
    {
        return $this->belongsTo(Leads::class);
    }

//    public function getOrderNameAttribute()
//    {
//        return $this->order->name;
//    }
//
//    public function getOrderTypeAttribute()
//    {
//        return $this->order->type;
//    }

}
