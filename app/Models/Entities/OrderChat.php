<?php


namespace App\Models\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $message
 * @property int $user_id
 * @property int $order_id
 * @property User $user
 * @property Order $order
 * @mixin \Eloquent
 */
class OrderChat extends Model
{
    protected $table = 'messages';

    protected $fillable = ['message', 'user_id', 'order_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
