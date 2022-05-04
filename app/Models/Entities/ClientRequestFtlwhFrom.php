<?php

namespace App\Models\Entities;

use App\Http\Requests\ClientRequest;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $client_request_id
 * @property string $unl_on
 * @property string $unl_cont_ktk_type
 * @property string $unl_cont_ktk_prefix
 * @property string $unl_cont_ktk_number
 * @property string $unl_cont_ktk_owner_name
 * @property string $unl_cont_ktk_owner_inn
 * @property boolean $client_has_container
 * @property string $client_container_place
 * @property string $tm_name
 * @property string $tm_code
 * @property string $tm_city
 * @property string $tm_address
 * @property string $tm_power_of_attorney_number
 * @property string $tm_power_of_attorney_scan
 * @property string $pickup_name
 * @property string $pickup_code
 * @property string $pickup_city
 * @property string $pickup_address
 * @property string $pickup_power_of_attorney_number
 * @property string $pickup_power_of_attorney_scan
 * @property string $unl_tr_name
 * @property string $unl_tr_code
 * @property string $unl_tr_address
 * @property string $unl_tr_railway_carriage_owner_name
 * @property string $unl_tr_railway_carriage_owner_inn
 * @property string $created_at
 * @property string $updated_at
 * @property ClientRequest $clientRequest
 * @property string $ftl_wh
 * @property float $unl_cont_ktk_weight
 * @property float $unl_cont_ktk_volume
 * @mixin \Eloquent
 */
class ClientRequestFtlwhFrom extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'client_request_ftlwh_from';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['unl_cont_ktk_weight', 'unl_cont_ktk_volume', 'ftl_wh', 'client_request_id', 'unl_on', 'unl_cont_ktk_type', 'unl_cont_ktk_prefix', 'unl_cont_ktk_number', 'unl_cont_ktk_owner_name', 'unl_cont_ktk_owner_inn', 'client_has_container', 'client_container_place', 'tm_name', 'tm_code', 'tm_city', 'tm_address', 'tm_power_of_attorney_number', 'tm_power_of_attorney_scan', 'pickup_name', 'pickup_code', 'pickup_city', 'pickup_address', 'pickup_power_of_attorney_number', 'pickup_power_of_attorney_scan', 'unl_tr_name', 'unl_tr_code', 'unl_tr_address', 'unl_tr_railway_carriage_owner_name', 'unl_tr_railway_carriage_owner_inn', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clientRequest()
    {
        return $this->belongsTo(ClientRequests::class);
    }
}
