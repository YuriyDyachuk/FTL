<?php

namespace App\Models\Entities\Block;

use App\Models\Entities\Block;
use App\Models\Entities\Order;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property integer $id
 * @property string $date
 * @property string $time
 * @property boolean $interval
 * @property string $time_from
 * @property string $time_to
 * @property int $block_type
 * @property int $block_id
 * @property string $created_at
 * @property string $updated_at
 */
class DateTimeBlock extends Block
{
    use Sortable;

//    public function clientNameSortable($query, $direction)
//    {
//        return $query->leftJoin('leads', 'leads.id', '=', 'car_orders.lead_id')
//            ->leftJoin('clients', 'clients.id', '=', 'leads.client_id')
//            ->orderBy('clients.name', $direction)
//            ->select('car_orders.*');
//    }

    public function orderIdSortable($query, $direction)
    {
        return $query->join('order as o', 'o.id', '=', 'datetime_block.block_id')
            ->whereIn('datetime_block.block_type', [
                Block::ORDER_TYPE,
                Block::FTL_TYPE,
                Block::CLIENT_TYPE,
                Block::PROVIDER_TYPE,
                Block::TERMINAL_TYPE,
                Block::TRAIN_TYPE,
                Block::HEAVY_RENT_TYPE
            ])
            ->where('o.type', Order::CAR_TYPE)
            ->orderBy('o.id', $direction)
            ->select([
                'datetime_block.id as id',
                'datetime_block.date as date',
                'o.id as order_id',
                'datetime_block.block_id',
                'o.status as status']);
    }

    public function orderStatusSortable($query, $direction)
    {
        return $query->join('order as o', 'o.id', '=', 'datetime_block.block_id')
            ->whereIn('datetime_block.block_type', [
                Block::ORDER_TYPE,
                Block::FTL_TYPE,
                Block::CLIENT_TYPE,
                Block::PROVIDER_TYPE,
                Block::TERMINAL_TYPE,
                Block::TRAIN_TYPE,
                Block::HEAVY_RENT_TYPE
            ])
            ->where('o.type', Order::CAR_TYPE)
            ->orderBy('o.status', $direction)
            ->select([
                'datetime_block.id as id',
                'datetime_block.date as date',
                'o.id as order_id',
                'datetime_block.block_id',
                'o.status as status']);
    }


    public function clientNameSortable($query, $direction)
    {
        return $query->join('order as o', 'o.id', '=', 'datetime_block.block_id')
            ->join('leads as l', 'l.id', '=', 'o.lead_id')
            ->join('clients', 'l.client_id', '=', 'clients.id')
            ->whereIn('datetime_block.block_type', [
                Block::ORDER_TYPE,
                Block::FTL_TYPE,
                Block::CLIENT_TYPE,
                Block::PROVIDER_TYPE,
                Block::TERMINAL_TYPE,
                Block::TRAIN_TYPE,
                Block::HEAVY_RENT_TYPE
            ])
            ->where('o.type', Order::CAR_TYPE)
            ->orderBy('clients.name', $direction)
            ->select([
                'datetime_block.id as id',
                'datetime_block.date as date',
                'o.id as order_id',
                'datetime_block.block_id',
                'o.status as status']);
    }



    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'datetime_block';

    public function blockTitle():string
    {
        return 'dateTime';
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
    protected $fillable = ['date', 'time', 'interval', 'time_from', 'time_to', 'created_at', 'updated_at', 'block_type', 'block_id'];

}
