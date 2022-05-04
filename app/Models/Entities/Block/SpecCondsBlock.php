<?php

namespace App\Models\Entities\Block;

use App\Models\Entities\Block;
use App\Models\Entities\Order;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $description
 * @property string $file
 * @property string $transport
 * @property string $created_at
 * @property string $updated_at
 * @property int $order_id
 * @property Order $order
 */
class SpecCondsBlock extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spec_conds_block';

    public function getBlockTitle():string
    {
        return 'Особые условия';
    }

    public function getBlockType()
    {
        return Block::SPEC_CONDS_TYPE;
    }

    public function blockTitle():string
    {
        return 'specConds';
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
    protected $fillable = ['description', 'file', 'transport', 'created_at', 'updated_at', 'order_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
