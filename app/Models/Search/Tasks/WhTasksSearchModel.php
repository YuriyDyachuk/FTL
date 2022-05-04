<?php


namespace App\Models\Search\Tasks;


use App\Models\Entities\Block;
use App\Models\Entities\Block\DateTimeBlock;
use App\Models\Entities\Order;

class WhTasksSearchModel
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
            ->where('datetime_block.block_type', Block::ORDER_TYPE)
            ->where('order.type', Order::WH_TYPE);
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
