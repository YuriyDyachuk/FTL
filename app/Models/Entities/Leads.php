<?php

namespace App\Models\Entities;


use App\Models\Entities\Pivot\GoodsLeads;
use App\Models\Entities\Pivot\LeadsClients;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property integer $id
 * @property int $responsible_user_id
 * @property string $lead_date
 * @property string $deadline_date
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 * @property int $type
 * @property User $user
 * @property ClientRequests[] $clientRequest
 * @property Order[] $orders
 * @property Client $clients
 * @property int $enable
 * @mixin \Eloquent
 * @property Goods $goods
 */
class Leads extends Model
{
    use Sortable;

    const AGREED_STATUS = 1;
    const CREATED_NOT_AGREED_STATUS = 2;
    const NOT_AGREED_STATUS = 3;

    const CAR_TYPE = 1;
    const WH_TYPE = 2;
    const TR_TYPE = 3;

    const ENABLE = 1;
    const DISABLE = 0;

    protected $table = 'leads';

    public $sortable = ['id', 'created_at', 'status'];

    protected $keyType = 'integer';

    protected $fillable = ['enable', 'responsible_user_id', 'lead_date', 'deadline_date', 'created_at', 'updated_at', 'status', 'type'];

    public static function typesList():array
    {
        return [
            self::CAR_TYPE,
            self::WH_TYPE,
            self::TR_TYPE
        ];
    }

    public function isTrainType():bool
    {
        return $this->type === self::TR_TYPE;
    }

    public function isCarType():bool
    {
        return $this->type === self::CAR_TYPE;
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->lead_date = date('d.m.Y');
            $model->deadline_date = date('d.m.Y', strtotime('+60 days'));
        });
    }

    public function scopeEnabled()
    {
        return $this->where('enable', self::ENABLE);
    }

    public function scopeDisabled()
    {
        return $this->where('enable', self::DISABLE);
    }

    public function getShortLabel():string
    {
        switch ($this->type){
            case self::TR_TYPE:
                $type = 'tr';
                break;
            case self::CAR_TYPE:
                $type = 'car';
                break;
            case self::WH_TYPE:
                $type = 'wh';
                break;
        }

        return $type;
    }

    public static function getStatusColor($status)
    {
        switch($status){
            case self::NOT_AGREED_STATUS:
                $color = 'bg-danger';
                break;
            case self::CREATED_NOT_AGREED_STATUS:
                $color = 'bg-warning';
                break;
            case  self::AGREED_STATUS:
                $color = 'bg-success';
                break;
            default:
                $color = 'bg-danger';
                break;
        }
        return $color;
    }

    public static function getStatusLabel($status)
    {
        switch ($status){
            case self::NOT_AGREED_STATUS:
                $label = 'Не согласован';
                break;
            case self::CREATED_NOT_AGREED_STATUS:
                $label = 'Создан. Не согласован';
                break;
            case  self::AGREED_STATUS:
                $label = 'Согласован';
                break;
            default:
                $label = 'Не согласован';
                break;
        }
        return $label;
    }

    public static function getPhotoThColor(Leads $lead)
    {
        if(\Storage::exists('public/images/'.$lead->warehouseRequestForwardingOnGetting['photo'])
            && !empty($lead->warehouseRequestForwardingOnGetting['photo_date'])){
            $color = 'bg-success';
        }else{
            $color = '';
        }
        return $color;
    }

    public function getClientsNames()
    {
        return $this->clients()->pluck('name')->implode(', ');
    }

    public function getClientsInns()
    {
        return $this->clients()->pluck('inn')->implode(', ');
    }

    public function getClientsIds()
    {
        return $this->clients()->pluck('id')->toArray();
    }

    public function leadsClients()
    {
        return $this->hasMany(LeadsClients::class, 'lead_id');
    }

    public function goods()
    {
        return $this->belongsToMany(Goods::class, GoodsLeads::class, 'lead_id');
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, LeadsClients::class, 'lead_id');
    }

    public function clientRequest()
    {
        return $this->hasOne(ClientRequests::class, 'lead_id', 'id');
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'lead_id', 'id');
    }

    public function responsibleUser()
    {
        return $this->hasOne(User::class, 'id', 'responsible_user_id');
    }

    public function getDriverReportByName($name)
    {
        return $this->with(['orders' => function($q)use($name){
            $q->where('name', '=', $name);
        }])->driverReport();
    }

    public function getOrdersByName(int $name)
    {
        return $this->orders()->where('name', $name)->getModels();
    }

    public function getOrders()
    {
        $data = [
            $this->getOrdersByName(Order::CAR_PROVIDER_CLIENT_NAME),
            $this->getOrdersByName(Order::CAR_PROVIDER_FTL_NAME),
            $this->getOrdersByName(Order::WH_GETTING_NAME),
            $this->getOrdersByName(Order::WH_KTK_DOWNLOADING_NAME),

            $this->getOrdersByName(Order::CAR_TM_FTL_TR_NAME),
            $this->getOrdersByName(Order::WH_CROSS_NAME),
            $this->getOrdersByName(Order::CAR_TM_PROVIDER_TR_NAME),

            $this->getOrdersByName(Order::TR_NAME),
            $this->getOrdersByName(Order::CAR_TR_FTL_TM_NAME),
            $this->getOrdersByName(Order::CAR_TR_CLIENT_TM_NAME),

            $this->getOrdersByName(Order::CAR_FTL_CLIENT_NAME),
            $this->getOrdersByName(Order::CAR_FTL_TM_NAME),
            $this->getOrdersByName(Order::CAR_HEAVY_RENT_NAME),
        ];

        return (new Collection($data))->collapse();
    }

//    public function checkOrderEditPermission($relationName)
//    {
//        if(in_array($this->status, [self::AGREED_STATUS, self::NOT_AGREED_STATUS])){
//            return false;
//        }
//        $relation = $this->$relationName()->get()->map->only(['responsible_user_id', 'responsible_chief_id']);
//        return $relation;
//    }

}



