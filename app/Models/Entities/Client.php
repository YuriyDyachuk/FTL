<?php

namespace App\Models\Entities;

use App\Models\Entities\ClientContact;
use App\Models\Entities\Pivot\LeadsClients;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
/**
 * @property integer $id
 * @property string $name
 * @property string $inn
 * @property string $created_at
 * @property string $updated_at
 * @property string $ogrn
 * @property string $leg_address
 * @property string $mail_address
 * @property string $fact_address
 * @property string $signatory
 * @property string $fio
 * @property string $power_of_attorney
 * @property string $kpp
 * @property string $okpo
 * @property string $bank
 * @property string $bik
 * @property string $k_account
 * @property string $r_account
 * @property boolean $regulation_1
 * @property boolean $regulation_2
 * @property boolean $regulation_3
 * @property boolean $regulation_4
 * @property boolean $regulation_5
 * @property boolean $regulation_6
 * @property boolean $regulation_7
 * @property boolean $regulation_8
 * @property boolean $regulation_9
 * @property boolean $regulation_10
 * @property boolean $regulation_11
 * @property boolean $regulation_12
 * @property boolean $regulation_13
 * @property boolean $regulation_14
 * @property boolean $regulation_15
 * @property boolean $regulation_16
 * @property boolean $regulation_17
 * @property boolean $regulation_18
 * @property boolean $regulation_19
 * @property boolean $regulation_20
 * @property boolean $regulation_21
 * @property boolean $regulation_22
 * @property boolean $regulation_23
 * @property boolean $regulation_24
 * @property ClientContact[] $clientContacts
 * @property integer $responsible_manager_id
 * @property Leads $leads
 * @mixin \Eloquent
 */
class Client extends Model
{
    use Sortable;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    public static function getList()
    {
        return self::where('name', '!=', null)->get()->pluck('name', 'id');
    }

    /**
     * @var array
     */
    protected $fillable = ['responsible_manager_id', 'name', 'inn', 'created_at', 'updated_at', 'ogrn', 'leg_address', 'mail_address', 'fact_address', 'signatory', 'fio', 'power_of_attorney', 'kpp', 'okpo', 'bank', 'bik', 'k_account', 'r_account', 'regulation_1', 'regulation_2', 'regulation_3', 'regulation_4', 'regulation_5', 'regulation_6', 'regulation_7', 'regulation_8', 'regulation_9', 'regulation_10', 'regulation_11', 'regulation_12', 'regulation_13', 'regulation_14', 'regulation_15', 'regulation_16', 'regulation_17', 'regulation_18', 'regulation_19', 'regulation_20', 'regulation_21', 'regulation_22', 'regulation_23', 'regulation_24'];

    public function contacts()
    {
        return $this->hasMany(ClientContact::class, 'client_id', 'id');
    }

    public function lead()
    {
        return $this->hasMany(Leads::class, 'client_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'name', 'name');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'responsible_manager_id', 'id');
    }

    public function leads()
    {
        return $this->belongsToMany(Leads::class, LeadsClients::class, 'client_id', 'lead_id');
    }
}
