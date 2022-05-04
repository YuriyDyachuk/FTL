<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property integer $id
 * @property string $name
 * @property string $weight
 * @property string $volume
 * @property string $download_type
 * @property string $pallet_size
 * @property string $amount
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 * @property int $getting_act_id
 * @property GettingAct $gettingAct
 * @property string $provider_name
 * @property string $provider_inn
 * @property int $cargo_type_id
 * @mixin \Eloquent
 */
class GettingActCargo extends Model
{
    use Sortable;

    const IN_PROCESS_STATUS = 1;
    const IN_THE_WAREHOUSE_STATUS = 2;
    const IN_THE_CONTAINER_STATUS = 3;
    const DONE_STATUS = 4;

    public static function statusesList():array
    {
        return [
            self::IN_PROCESS_STATUS => 'В пути на прибытие',
            self::IN_THE_WAREHOUSE_STATUS => 'На складе',
            self::IN_THE_CONTAINER_STATUS => 'В контейнере',
            self::DONE_STATUS => 'Доставлен',
        ];
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'getting_act_cargo';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['cargo_type_id', 'provider_name', 'provider_inn', 'name', 'weight', 'volume', 'download_type', 'pallet_size', 'amount', 'created_at', 'updated_at', 'status', 'getting_act_id'];

    public function gettingAct()
    {
        return $this->belongsTo(GettingAct::class);
    }

    public function cargoType()
    {
        return $this->belongsTo(CargoTypes::class, 'cargo_type_id');
    }

}
