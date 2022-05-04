<?php

namespace App\Models\Policies;

use App\Models\Entities\EntityStatus;
use App\Models\Entities\Order;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function editGoods(User $user, Order $order)
    {
        return $order->status === EntityStatus::NEW_STATUS &&
            $user->id === $order->lead->responsible_user_id;
    }

    public function singleReport(User $user, Order $order)
    {
        return $order->status === EntityStatus::IN_PROCESS_STATUS && $user->id === $order->responsible_user_id;
    }
}
