<?php

namespace App\Models\Entities\Pivot;

use App\Models\Entities\Client;
use App\Models\Entities\Leads;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $lead_id
 * @property integer $client_id
 * @property string $created_at
 * @property string $updated_at
 * @property Client $client
 * @property Leads $lead
 * @mixin \Eloquent
 */
class LeadsClients extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['lead_id', 'client_id', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return BelongsTo
     */
    public function lead()
    {
        return $this->belongsTo(Leads::class);
    }
}
