<?php

namespace App\Models\Entities\Block;

use App\Models\Entities\Block;
use App\Models\Entities\Order;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $city
 * @property string $name
 * @property string $address
 * @property string $driving_scheme
 * @property string $created_at
 * @property string $updated_at
 * @property int $order_id
 * @property Order $order
 */
class ClientBlock extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'client_block';

    public function getBlockTitle():string
    {
        return 'Клиент';
    }

    public function getBlockType()
    {
        return Block::CLIENT_TYPE;
    }

    public function blockTitle():string
    {
        return 'client';
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
    protected $fillable = ['city', 'name', 'address', 'driving_scheme', 'created_at', 'updated_at', 'order_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dateTimeBlock()
    {
        return $this->hasOne(DateTimeBlock::class, 'block_id', 'id')
            ->where('block_type', Block::CLIENT_TYPE);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agentBlock()
    {
        return $this->hasMany(AgentBlock::class, 'block_id', 'id')
            ->where('block_type', Block::CLIENT_TYPE);
    }

}
