<?php

namespace App\Models\Entities\Block;

use App\Models\Entities\Block;
use App\Models\Entities\Order;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property integer $id
 * @property integer $order_id
 * @property int $type
 * @property string $date
 * @property string $time
 * @property string $city
 * @property string $name
 * @property string $code
 * @property string $address
 * @property string $fio
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 * @property Order $order
 */
class TrainOrderBlock extends Model
{
    use Sortable;

    const BEGIN_TYPE = 1;
    const END_TYPE = 2;

    public static function types():array
    {
        return [
            self::BEGIN_TYPE => 'Отправление',
            self::END_TYPE => 'Получение'
        ];
    }

    public function getBlockTitle():string
    {
        $title = 'Отправление';
        if($this->type == self::END_TYPE){
            $title = 'Получение';
        }

        return $title;
    }

    public function getBlockType()
    {
        return Block::TRAIN_ORDER_TYPE;
    }

    public function blockTitle():string
    {
        return 'trainOrder';
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'train_order_block';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'type', 'date', 'time', 'city', 'name', 'code', 'address', 'fio', 'phone', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
