<?php

namespace App\Models\Repositories;

use App\Models\Entities\Block;
use App\Models\Entities\EntityStatus;
use App\Models\Entities\Goods;
use App\Models\Entities\Order;
use App\Models\Entities\OrderNotes;
use App\Models\Entities\Pivot\GoodsOrders;
use App\Models\Repositories\Block\BlockRepository;
use Auth;

class OrderRepository extends BlockRepository
{
    public function create(
        int $type,
        int $name,
        string $index,
        int $leadId,
        int $status,
        int $active_responsible_user_id,
        int $wh_gt_order_id = null,
        int $is_single = Order::NOT_SINGLE
    ) {
        $order = Order::create([
            'type' => $type,
            'name' => $name,
            'index' => $index,
            'lead_id' => $leadId,
            'status' => $status,
            'active_responsible_user_id' => $active_responsible_user_id,
            'wh_gt_order_id' => $wh_gt_order_id,
            'is_single' => $is_single
        ]);

        return $order;
    }

    public function getById(int $id):Order
    {
        return Order::find($id);
    }

    public function removeGoods(Order $order)
    {
        //$order->goodsOrders()->delete();
        $order->goods()->delete();
    }

    public function createGoods(Order $order, array $products)
    {
        $createdProducts = [];
        foreach ($products as $product) {
            $productModel = Goods::create($product);
            GoodsOrders::create(['order_id' => $order->id, 'goods_id' => $productModel->id, 'order_name' => $order->name, 'order_type' => $order->type]);
            $createdProducts[] = $productModel;
        }

        return $createdProducts;
    }

    public function update(array $requestArray)
    {
        $user = Auth::getUser();
        $orderQuery = Order::where('id', $requestArray['order_id']);
        $order = $orderQuery->first();
        $leadManagerId = $order->lead->responsible_user_id;

        switch($order->status){
            case EntityStatus::NEW_STATUS:
                switch ($requestArray['desc']){
                    case OrderNotes::COORDINATION_NOTE_DESC:
                        if($user->id == $order->active_responsible_user_id && $user->id == $leadManagerId && $user->id == $order->responsible_user_id){
                            $orderQuery->update(['status' => EntityStatus::IN_PROCESS_STATUS]);
                        }elseif($user->id == $order->active_responsible_user_id && $user->id == $leadManagerId){
                            $orderQuery->update(['active_responsible_user_id' => $order->responsible_user_id]);
                        }elseif($user->id == $order->active_responsible_user_id && $user->id == $order->responsible_user_id){
                            $orderQuery->update(['status' => EntityStatus::IN_PROCESS_STATUS]);
                        }
                        break;
                    case OrderNotes::ADJUSTMENTS_NOTE_DESC:
                        if($user->id == $order->active_responsible_user_id && $user->id == $order->responsible_user_id){
                            $orderQuery->update(['active_responsible_user_id' => $leadManagerId]);
                        }
                        break;
                }
                break;
            case EntityStatus::IN_PROCESS_STATUS:
                switch ($requestArray['desc']){
                    case OrderNotes::COORDINATION_NOTE_DESC:
                        if($user->id == $order->active_responsible_user_id && $user->id == $leadManagerId && $user->id == $order->responsible_user_id){
                            $orderQuery->update(['status' => EntityStatus::DONE_STATUS]);
                        }elseif($user->id == $order->active_responsible_user_id && $user->id == $order->responsible_user_id){
                            $orderQuery->update(['active_responsible_user_id' => $leadManagerId]);
                        }elseif($user->id == $order->active_responsible_user_id && $user->id == $leadManagerId){
                            $orderQuery->update(['status' => EntityStatus::DONE_STATUS]);
                        }
                        break;
                    case OrderNotes::ADJUSTMENTS_NOTE_DESC:
                        if($user->id == $order->active_responsible_user_id && $user->id == $leadManagerId && $user->id == $order->responsible_user_id){
                            $orderQuery->update(['status' => EntityStatus::NEW_STATUS]);
                        }elseif($user->id == $order->active_responsible_user_id && $user->id == $leadManagerId){
                            $orderQuery->update(['active_responsible_user_id' => $order->responsible_user_id]);
                        }
                        break;
                }
                break;
            case EntityStatus::DONE_STATUS:
                switch ($requestArray['desc']){
                    case OrderNotes::ADJUSTMENTS_NOTE_DESC:
                        $orderQuery->update(['status' => EntityStatus::NEW_STATUS]);
                        break;
                }
                break;
        }
    }


    public function getCarOrders(int $isSingle)
    {
        return Order::with(['lead', 'lead.clients'])->singleValue($isSingle)->car();
    }

    public function getWhOrders(int $isSingle)
    {
        return Order::with(['lead', 'lead.clients'])->singleValue($isSingle)->wh();
    }

    public function getTrOrders(int $isSingle)
    {
        return Order::with(['lead', 'lead.clients'])->singleValue($isSingle)->tr();
    }

    public function getCarOrdersForBranchChief($branchChiefId, int $isSingle)
    {
        return Order::with(['lead', 'lead.clients'])->singleValue($isSingle)->car()->branchChief($branchChiefId);
    }

    public function getWhOrdersForBranchChief($branchChiefId, int $isSingle)
    {
        return Order::with(['lead', 'lead.clients'])->singleValue($isSingle)->wh()->branchChief($branchChiefId);
    }

    public function getTrOrdersForBranchChief($branchChiefId, int $isSingle)
    {
        return Order::with(['lead', 'lead.clients'])->singleValue($isSingle)->tr()->branchChief($branchChiefId);
    }

    public function getCarOrdersForResponsible($responsibleId, int $isSingle)
    {
        return Order::with(['lead', 'lead.clients'])->singleValue($isSingle)->car()->responsible($responsibleId);
    }

    public function getWhOrdersForResponsible($responsibleId, int $isSingle)
    {
        return Order::with(['lead', 'lead.clients'])->singleValue($isSingle)->wh()->responsible($responsibleId);
    }

    public function getTrOrdersForResponsible($responsibleId, int $isSingle)
    {
        return Order::with(['lead', 'lead.clients'])->singleValue($isSingle)->tr()->responsible($responsibleId);
    }

    public function getCarOrdersForActiveResponsible($activeResponsibleId)
    {
        return Order::with(['lead', 'lead.clients'])->car()->activeResponsible($activeResponsibleId);
    }

    public function getWhOrdersForActiveResponsible($activeResponsibleId)
    {
        return Order::with(['lead', 'lead.clients'])->wh()->activeResponsible($activeResponsibleId);
    }

    public function getTrOrdersForActiveResponsible($activeResponsibleId)
    {
        return Order::with(['lead', 'lead.clients'])->tr()->activeResponsible($activeResponsibleId);
    }

    public function getCarOrdersForClient(string $clientName, int $isSingle)
    {
        return Order::with(['lead', 'lead.clients'])->singleValue($isSingle)->car()->client($clientName);
    }

    public function getWhOrdersForClient(string $clientName, int $isSingle)
    {
        return Order::with(['lead', 'lead.clients'])->singleValue($isSingle)->wh()->client($clientName);
    }

    public function getTrOrdersForClient(string $clientName, int $isSingle)
    {
        return Order::with(['lead', 'lead.clients'])->singleValue($isSingle)->tr()->client($clientName);
    }

}
