<?php

namespace App\Models\Entities;

use App\Models\Entities\ClientRequestProducts;
use App\Models\Entities\Leads;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property integer $id
 * @property integer $lead_id
 * @property string $request_date
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 * @property string $notes
 * @property boolean $warming
 * @property boolean $forwarding_enabled
 * @property integer $forwarding_id
 * @property Leads $lead
 * @property ClientRequestFrom[] $clientRequestFroms
 * @property ClientRequestProducts[] $products
 * @property ClientRequestTo[] $clientRequestTos
 * @property string $delivery_date
 * @property integer $active_responsible_user_id
 * @property WarehouseCargo $warehouseCargos
 * @mixin \Eloquent
 */
class ClientRequests extends Model
{
    use Sortable;

    public $sortable = [
        'id',
        'created_at',
        'status'
    ];

    /*
     * ORDER TYPES
     */
    const PRWH_PRWH = 'prwh_prwh';
    const PRWH_TR = 'prwh_tr';
    const PRWH_FTL = 'prwh_ftl';

    const TR_PRWH = 'tr_prwh';
    const TR_FTL = 'tr_ftl';
    const TR_TR = 'tr_tr';

    const FTL_FTL = 'ftl_ftl';
    const FTL_TR = 'ftl_tr';
    const FTL_PRWH = 'ftl_prwh';


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'client_requests';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->request_date = date('d.m.Y');
        });
    }

    public function clientNameSortable($query, $direction)
    {
        return $query->leftJoin('leads as l', 'client_requests.lead_id', '=', 'l.id')
            ->leftJoin('clients as c', 'l.client_id', '=', 'c.id')
            ->orderBy('c.name', $direction)
            ->select('client_requests.*');
    }

    public function leadIdSortable($query, $direction)
    {
        return $query->leftJoin('leads as l', 'client_requests.lead_id', '=', 'l.id')
            ->orderBy('l.id', $direction)
            ->select('client_requests.*');
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
    protected $fillable = ['active_responsible_user_id', 'lead_id', 'request_date', 'created_at', 'updated_at', 'status', 'notes', 'warming', 'forwarding_enabled', 'forwarding_id', 'delivery_date'];

    public function warehouseCargos()
    {
        return $this->hasMany(WarehouseCargo::class, 'client_request_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientRequestFroms()
    {
        return $this->hasMany(ClientRequestFrom::class, 'client_request_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientRequestTos()
    {
        return $this->hasMany(ClientRequestTo::class, 'client_request_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(ClientRequestProducts::class, 'client_request_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lead()
    {
        return $this->belongsTo(Leads::class,'lead_id');
    }

    public function forwardingRelation()
    {
        return $this->hasOne(Forwarding::class, 'id', 'forwarding_id');
    }

    public function ftlwhFrom()
    {
        return $this->hasOne(ClientRequestFtlwhFrom::class, 'client_request_id', 'id');
    }

    public function ftlwhTo()
    {
        return $this->hasOne(ClientRequestFtlwhTo::class, 'client_request_id', 'id');
    }

    public function orderNotes()
    {
        return $this->hasMany(OrderNotes::class, 'client_requests_id', 'id');
    }

    public function trFromTo()
    {
        return $this->hasOne(ClientRequestTrFromTo::class, 'clientrequest_id', 'id');
    }

}
