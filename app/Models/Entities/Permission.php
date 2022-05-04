<?php


namespace App\Models\Entities;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    const LEAD_GROUP = 1;
    const CLIENT_REQUEST_GROUP = 2;
    const TRAIN_GROUP = 3;
    const CAR_GROUP = 4;
    const WH_GROUP = 5;
    const PGT_GROUP = 6;
    const BRANCH_GROUP = 7;
    const DEFAULT_GROUP = 8;
    const CLIENTS_GROUP = 9;

    protected $fillable = ['name', 'display_name', 'description', 'permission_group'];

    public static function getPermissionGroup()
    {
        return [
            self::LEAD_GROUP => 'Сделки',
            self::CLIENT_REQUEST_GROUP => 'Клиентские заявки',
            self::TRAIN_GROUP =>'ЖД',
            self::CAR_GROUP =>'Авто',
            self::WH_GROUP =>'Склад',
            self::PGT_GROUP =>'ПГТ',
            self::BRANCH_GROUP =>'Филиал',
            self::DEFAULT_GROUP => 'Общая',
            self::CLIENTS_GROUP => 'Клиенты'
        ];
    }

    public function getGroupName()
    {
        return self::getPermissionGroup()[$this->permission_group];
    }
}
