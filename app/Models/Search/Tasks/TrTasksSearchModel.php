<?php


namespace App\Models\Search\Tasks;


use App\Models\Entities\Block\TrainOrderBlock;

class TrTasksSearchModel
{
    public function search(array $params)
    {
        $query = TrainOrderBlock::query();
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
