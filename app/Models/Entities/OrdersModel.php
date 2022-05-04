<?php

namespace App\Models\Entities;

use DB;
use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    public function getOriginStatus()
    {
        $query = DB::table($this->getAttribute('table'))->select('status')->where('id', $this->origin_id);
        if($query->exists()){
            return $query->first()->status;
        }
        return null;
    }

    public function getActiveResponsibleUserName()
    {
        $query = DB::table($this->getAttribute('table'))->select(
            [
                'active_responsible_user_id',
                $this->getAttribute('table').'.id',
                'users.name as respname'
            ]
        )
            ->leftJoin('users', 'users.id', '=', $this->getAttribute('table').'.active_responsible_user_id')
            ->where($this->getAttribute('table').'.id', $this->origin_id);
        if($query->exists()){
            return $query->first()->respname;
        }

        return null;
    }
}
