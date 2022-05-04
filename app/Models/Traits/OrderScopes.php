<?php


namespace App\Models\Traits;


use App\Models\Entities\Order;
use Illuminate\Database\Query\Builder;

trait OrderScopes
{
    public function scopeNew($query, $or = false)
    {
        if($or === true){
            $query->orWhere('order.status', Order::NEW_STATUS);
        }else{
            $query->where('order.status', Order::NEW_STATUS);

        }
    }

    public function scopeInProcess($query, $or = false)
    {
        if($or === true){
            $query->orWhere('order.status', Order::IN_PROCESS_STATUS);
        }else{
            $query->where('order.status', Order::IN_PROCESS_STATUS);
        }
    }

    public function scopeDone($query, $or = false)
    {
        if($or === true){
            $query->orWhere('order.status', Order::DONE_STATUS);
        }else{
            $query->where('order.status', Order::DONE_STATUS);
        }
    }

    public function scopeResponsible($query, $id)
    {
        $query->where('order.responsible_user_id', $id);
    }

    public function scopeActiveResponsibleName($query, $name, $or = false)
    {
        if($or === true){
            $query->leftJoin('users as u', 'u.id', '=', 'order.active_responsible_user_id')
                ->select(['order.*', 'u.name as active_resp_name'])
                ->orWhere('u.name', 'like', '%'.$name.'%');
        }else{
            $query->leftJoin('users as u', 'u.id', '=', 'order.active_responsible_user_id')
                ->select(['order.*', 'u.name as active_resp_name'])
                ->where('u.name', 'like', '%'.$name.'%');
        }
    }

    public function scopeActiveResponsible($query, $id, $or = false)
    {
        if($or){
            $query->orWhere('order.active_responsible_user_id', $id);
        }else{
            $query->where('order.active_responsible_user_id', $id);
        }
    }

    public function scopeChief($query, $id)
    {
        $query->where('order.responsible_chief_id', $id);
    }

    public function scopeBranchChief($query, $id)
    {
        $query->where('order.responsible_branch_chief_id', $id);
    }

    public function scopeCar($query)
    {
        $query->where('order.type', self::CAR_TYPE);
    }

    public function scopeWh($query)
    {
        $query->where('order.type', self::WH_TYPE);
    }

    public function scopeTr($query)
    {
        $query->where('order.type', self::TR_TYPE);
    }

    public function scopeClient($query, $clientName, $or = false)
    {
        if($or === true){
            $query->with(['lead', 'lead.client'])
                ->whereHas('lead.client', function ($q)use($clientName){
                    $q->orWhere('name', $clientName);
                });
        }else{
            $query->with(['lead', 'lead.client'])
                ->whereHas('lead.client', function ($q)use($clientName){
                    $q->where('name', 'LIKE', '%'.$clientName.'%');
                });
        }

    }
}
