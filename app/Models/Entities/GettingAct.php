<?php

namespace App\Models\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property integer $id
 * @property int $responsible_user_id
 * @property string $date
 * @property string $time
 * @property int $client_id
 * @property Client $client
 * @property string $provider_name
 * @property string $created_at
 * @property string $updated_at
 * @property GettingActCargo $cargo
 * @property int $order_id
 * @mixin \Eloquent
 */
class GettingAct extends Model
{
    use Sortable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'getting_act';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'responsible_user_id', 'date', 'time', 'client_id', 'provider_name', 'created_at', 'updated_at'];

    public function responsibleUser()
    {
        return $this->belongsTo(User::class, 'responsible_user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function cargo()
    {
        return $this->hasMany(GettingActCargo::class);
    }

    public function driverReport()
    {
        return $this->hasOne(GettingActDriverReport::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
