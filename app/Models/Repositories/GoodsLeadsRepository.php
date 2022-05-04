<?php


namespace App\Models\Repositories;


use App\Models\Entities\Pivot\GoodsLeads;

class GoodsLeadsRepository
{
    public function create(int $leadId, int $goodsId):void
    {
        GoodsLeads::create(['lead_id' => $leadId, 'goods_id' => $goodsId]);
    }
}
