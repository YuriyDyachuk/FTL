<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $clientrequest_id
 * @property string $from_date
 * @property string $from_city
 * @property string $from_contact_name
 * @property string $from_contact_phone
 * @property string $from_power_of_attorney_number
 * @property string $from_power_of_attorney_scan
 * @property string $to_city
 * @property string $to_contact_name
 * @property string $to_contact_phone
 * @property string $to_power_of_attorney_number
 * @property string $to_power_of_attorney_scan
 * @property string $created_at
 * @property string $updated_at
 * @property ClientrequestTrFromto $clientrequestTrFromto
 */
class ClientRequestTrFromTo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clientrequest_tr_fromto';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['clientrequest_id', 'from_date', 'from_city', 'from_contact_name', 'from_contact_phone', 'from_power_of_attorney_number', 'from_power_of_attorney_scan', 'to_city', 'to_contact_name', 'to_contact_phone', 'to_power_of_attorney_number', 'to_power_of_attorney_scan', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clientRequest()
    {
        return $this->belongsTo(ClientRequests::class, 'clientrequest_id');
    }
}
