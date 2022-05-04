<?php

namespace App\Models\Entities;

use App\Models\Entities\Pivot\GoodsLeads;
use App\Models\Entities\Pivot\GoodsOrders;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property integer $id
 * @property float $weight
 * @property float $volume
 * @property int $amount
 * @property string $name
 * @property string $pallet_size
 * @property int $download_type
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property int $client_id
 * @mixin \Eloquent
 */
class Goods extends Model
{
    use Sortable;

    const NAVAL_DOWNLOAD_TYPE = 1;
    const PALLET_DOWNLOAD_TYPE = 2;

    const IN_PROCESS_STATUS = 1;
    const IN_THE_WAREHOUSE_STATUS = 2;
    const IN_THE_CONTAINER_STATUS = 3;
    const DONE_STATUS = 4;

    protected $table = 'goods';

    protected $keyType = 'integer';

    protected $fillable = ['client_id', 'weight', 'volume', 'amount', 'name', 'pallet_size', 'download_type', 'status', 'created_at', 'updated_at'];

    public static function statusesList():array
    {
        return [
            self::IN_PROCESS_STATUS => 'В пути на прибытие',
            self::IN_THE_WAREHOUSE_STATUS => 'На складе',
            self::IN_THE_CONTAINER_STATUS => 'В контейнере',
            self::DONE_STATUS => 'Доставлен',
        ];
    }

    public static function downloadTypesList():array
    {
        return [
            self::NAVAL_DOWNLOAD_TYPE => 'Навал',
            self::PALLET_DOWNLOAD_TYPE => 'Паллет'
        ];
    }

    public function getStatusLabelAttribute():string
    {
        return self::statusesList()[$this->status];
    }

    public function getDownloadTypeLabelAttribute():string
    {
        return self::downloadTypesList()[$this->download_type];
    }

    public function downloadTypeIsPallet()
    {
        return $this->download_type === self::PALLET_DOWNLOAD_TYPE;
    }

    public static function palletSizesList():array
    {
        return [
            '1200*80*1600',
            '1200*80*1800',
            '1200*80*20'
        ];
    }

    public function lead()
    {
        return $this->belongsTo(Leads::class, GoodsLeads::class, 'lead_id');
    }

    public function goodsLeads()
    {
        return $this->hasOne(GoodsLeads::class);
    }

    public function goodsOrders()
    {
        return $this->hasOne(GoodsOrders::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
