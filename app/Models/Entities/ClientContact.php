<?php

namespace App\Models\Entities;

use App\Models\Entities\Client;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $client_id
 * @property string $name
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 * @property string $position
 * @property string $email
 * @property string $photo
 * @property Client $client
 */
class ClientContact extends Model
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
    protected $fillable = ['client_id', 'name', 'phone', 'created_at', 'updated_at', 'position', 'email', 'photo'];

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
