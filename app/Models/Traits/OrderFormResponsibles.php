<?php


namespace App\Models\Traits;


use App\User;

trait OrderFormResponsibles
{
    public function responsibleUser()
    {
        return $this->belongsTo(User::class,'responsible_user_id', 'id');
    }

    public function activeResponsibleUser()
    {
        return $this->belongsTo(User::class,'active_responsible_user_id', 'id');
    }

    public function responsibleChief()
    {
        return $this->belongsTo(User::class,'responsible_chief_id', 'id');
    }

    public function responsibleBranchChief()
    {
        return $this->belongsTo(User::class,'responsible_branch_chief_id', 'id');
    }
}
