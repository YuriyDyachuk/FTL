<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property integer $id
 * @property string $name
 * @property string $download_type
 * @property string $created_at
 * @property string $updated_at
 * @property string $provider_name
 * @property int $client_id
 * @property Client $client
 * @property string $pallet_size
 */
class CargoTypes extends Model
{
    use Sortable;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'download_type', 'created_at', 'updated_at', 'provider_name', 'client_id', 'pallet_size'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
