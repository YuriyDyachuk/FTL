<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $type_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property ClientImagesTypes $clientImagesType
 * @property integer $client_id
 * @property Client $client
 * @property string $file_name
 */
class ClientImages extends Model
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
    protected $fillable = ['file_name', 'client_id', 'type_id', 'name', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(ClientImagesTypes::class, 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

}
