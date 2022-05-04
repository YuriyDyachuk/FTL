<?php

namespace App\Models\Entities;

use App\Models\Entities\ClientRequestFrom;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $client_request_from_id
 * @property string $fio
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 * @property ClientRequestFrom $clientRequestFrom
 */
class ClientRequestFromContacts extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['client_request_from_id', 'fio', 'phone', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clientRequestFrom()
    {
        return $this->belongsTo(ClientRequestFrom::class);
    }
}
