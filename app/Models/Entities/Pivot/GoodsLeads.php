<?php

namespace App\Models\Entities\Pivot;

use App\Models\Entities\Goods;
use App\Models\Entities\Leads;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $lead_id
 * @property integer $goods_id
 * @property string $created_at
 * @property string $updated_at
 * @property Goods $good
 * @property Leads $lead
 * @mixin \Eloquent
 */
class GoodsLeads extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['lead_id', 'goods_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function good()
    {
        return $this->belongsTo(Goods::class, 'goods_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lead()
    {
        return $this->belongsTo(Leads::class);
    }
}
