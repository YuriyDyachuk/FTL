<?php


namespace App\Models\Traits;


use App\Models\Entities\EntityStatus;
use Auth;

trait OrderReport
{
    public function canEdit():bool
    {
        $canEdit = false;
        $userId = Auth::user()->id;
//        if($this->status == EntityStatus::DONE_STATUS){
//            return false;
//        }
        switch ($this->order->status){
            case EntityStatus::NEW_STATUS:
                if($userId == $this->order->responsible_user_id && $userId == $this->order->lead->responsible_user_id){
                    $canEdit = false;
                }elseif($userId == $this->order->responsible_user_id){
                    $canEdit = false;
                }
                break;
            case EntityStatus::IN_PROCESS_STATUS:
                if($userId == $this->order->responsible_user_id && $userId == $this->order->lead->responsible_user_id){
                    $canEdit = true;
                }elseif($userId == $this->order->responsible_user_id){
                    $canEdit = true;
                }
                break;
            case EntityStatus::DONE_STATUS:
                if($userId == $this->order->responsible_user_id && $userId == $this->order->lead->responsible_user_id){
                    $canEdit = false;
                }elseif($userId == $this->order->responsible_user_id){
                    $canEdit = false;
                }
                break;
        }

        return
            $userId == $this->order->active_responsible_user_id
            && $userId == $this->order->responsible_user_id
            && $this->order->status == EntityStatus::IN_PROCESS_STATUS;
    }

    public function isEmpty():bool
    {
        $attributes = $this->getAttributes();

        foreach ($attributes as $key => &$attribute) {
            if(blank($attribute)){
                unset($attributes[$key]);
            }
        }
        return count($attributes) === 0;
    }
}
