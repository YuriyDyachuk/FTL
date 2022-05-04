<?php


namespace App\Models\Search\Tasks;


use App\Models\Entities\Block;
use App\Models\Entities\Block\DateTimeBlock;
use App\Models\Entities\Order;
use DemeterChain\B;

class CarTasksSearchModel
{
    public function search(array $params)
    {
        $query = DateTimeBlock::join('order', 'order.id', '=', 'datetime_block.block_id')
            ->select([
                'datetime_block.id as id',
                'datetime_block.date as date',
                'order.id as order_id',
                'datetime_block.block_id',
                'order.status as status'])
            ->whereIn('datetime_block.block_type', [
                Block::ORDER_TYPE,
                Block::FTL_TYPE,
                Block::CLIENT_TYPE,
                Block::PROVIDER_TYPE,
                Block::TERMINAL_TYPE,
                Block::TRAIN_TYPE,
                Block::HEAVY_RENT_TYPE
            ])
            ->where('order.type', Order::CAR_TYPE);
            if(!array_key_exists('date', $params)){
                $query->where('date', date('d.m.Y'));
            }


        foreach ($params as $key => $param) {
            if($key === 'date'){
                $query->where('date', $param);
            }
        }

        return $query->sortable()->paginate(env('ITEMS_PER_PAGE'));

    }

}
