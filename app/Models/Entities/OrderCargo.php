<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property integer $id
 * @property integer $order_id
 * @property integer $cargo_id
 * @property string $created_at
 * @property string $updated_at
 * @property ClientRequestProducts $clientRequestProduct
 * @property Order $order
 * @property int $order_name
 * @property Leads $lead
 * @property int $lead_id
 * @property int $order_type
 * @mixin \Eloquent
 */
class OrderCargo extends Model
{
    use Sortable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_cargo';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'cargo_id', 'created_at', 'updated_at', 'order_name', 'lead_id', 'order_type'];

    public function clientNameSortable($query, $direction)
    {
        return $query->join('leads as l', 'l.id', '=', 'order_cargo.lead_id')
            ->join('clients as cl', 'cl.id', '=', 'l.client_id')
            ->orderBy('cl.name', $direction)
            ->select(['order_cargo.*']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clientRequestProduct()
    {
        return $this->belongsTo(ClientRequestProducts::class, 'cargo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lead()
    {
        return $this->belongsTo(Leads::class);
    }
}
