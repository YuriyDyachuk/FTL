<?php


namespace App\Models\Repositories;


use App\Models\Entities\PackingSizeCatalog;
use App\Models\Entities\PackingSizeCatalogOrder;

class PackingSizeCatalogOrderRepository
{

    public function removeAllForLeadOrder($orderId)
    {
        PackingSizeCatalogOrder::where(['train_lead_order_id' => $orderId])->delete();
    }

    public function create($orderId, $sizeId)
    {
        $model = new PackingSizeCatalogOrder;
        $model->train_lead_order_id = (int)$orderId;
        $model->packing_size_catalog_id = (int)$sizeId;
        $model->save();
    }
}
