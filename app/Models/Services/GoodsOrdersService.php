<?php


namespace App\Models\Services;

use App\Models\Entities\Order;
use App\Models\Entities\OrderCargo;
use App\Models\Repositories\GoodsOrdersRepository;

class GoodsOrdersService
{
    private $goodsOrdersRepository;

    public function __construct(GoodsOrdersRepository $goodsOrdersRepository)
    {
        $this->goodsOrdersRepository = $goodsOrdersRepository;
    }

    public function deleteByOrderId(int $orderId)
    {
        return $this->goodsOrdersRepository->deleteByOrderId($orderId);
    }

    public function syncWithOrder(Order $order)
    {
        if($order->goodsOrders()->exists() && $order->whGtOrder()->exists()){
            $orderGoods = $order->goodsOrders;
            foreach ($orderGoods as $orderGoodsItem) {
                $data = $orderGoodsItem->toArray();
                $data['order_id'] = $order->whGtOrder->id;
                $data['order_name'] = $order->whGtOrder->name;
                $data['order_type'] = $order->whGtOrder->type;
                $this->goodsOrdersRepository->create($data['order_id'], $orderGoodsItem['goods_id'], $data['order_name'], $data['order_type'], $orderGoodsItem['lead_id']);
            }
        }
    }
}
