<?php


namespace App\Models\Permissions;

use App\Models\Entities\EntityStatus;
use App\Models\Entities\Leads;
use Auth;
use Illuminate\Database\Eloquent\Model;

class OrderOwnerPermission
{
    public static function check(?Model $model, Leads $lead)
    {
        return in_array(Auth::id(), [$model['active_responsible_user_id'], $lead->responsible_user_id]) || Auth::getUser()->hasRole('admin');
    }

    public static function canCreateOrder(Leads $lead)
    {
        return Auth::id() == $lead['responsible_user_id'] || Auth::getUser()->hasRole('admin');
    }
}
