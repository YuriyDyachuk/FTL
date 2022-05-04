<?php

namespace App;

use App\Models\Entities\Client;
use App\Models\Entities\Leads;
use Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * Class User
 * @package App
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $photo
 * @property Client $client
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    public static function boot()
    {
        parent::boot();
//        self::creating(function ($model) {
//            $model->password = Hash::make($model->password);
//        });
        self::updating(function($model){
            if(\Request::exists('password')){
                $model->password = Hash::make($model->password);
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function leads()
    {
        return $this->hasMany(Leads::class, 'responsible_user_id', 'id');
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'name', 'name');
    }

    public static function findByRolenames(array $roleNames)
    {
        return self::whereHas('roles', function($query) use($roleNames){
            $query->whereIn('name', $roleNames);
        })->get();
    }

    public static function findByRolename($roleName)
    {
        return self::whereHas('roles', function($query) use($roleName){
            $query->where('name', '=', $roleName);
        })->get();
    }

    public function getPhotoPath()
    {
        $photo = '/assets/media/users/default.jpg';
        if(is_file('storage/images/'.$this->photo)){
            $photo = '/storage/images/'.$this->photo;
        }
        return $photo;
    }
}
