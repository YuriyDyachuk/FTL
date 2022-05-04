<?php

namespace App\Models\Repositories;

use App\Models\Entities\Pivot\GoodsOrders;

class GoodsOrdersRepository
{
    public function deleteByOrderId(int $orderId)
    {
        return GoodsOrders::where('order_id', $orderId)->delete();
    }

    public function create(int $orderId, int $goodsId, int $orderName, int $orderType, int $leadId = null)
    {
        $model = new GoodsOrders();
        $model->order_id = $orderId;
        $model->goods_id = $goodsId;
        $model->order_name = $orderName;
        $model->order_type = $orderType;
        $model->lead_id = $leadId;
        $model->save();

        return $model;
    }
}
