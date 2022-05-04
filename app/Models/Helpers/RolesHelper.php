<?php


namespace App\Models\Helpers;


use App\User;

class RolesHelper
{
    public static function getCarWorkers()
    {
        return User::findByRolenames(['car_chief', 'car_dispatcher'])->pluck('name', 'id');
    }

    public static function getWhWorkers()
    {
        return User::findByRolenames(['wh_chief', 'wh_loader'])->pluck('name', 'id');
    }

    public static function getTrWorkers()
    {
        return User::findByRolenames(['tr_chief', 'tr_logistics'])->pluck('name', 'id');
    }
}
