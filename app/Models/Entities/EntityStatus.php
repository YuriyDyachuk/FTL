<?php


namespace App\Models\Entities;


class EntityStatus
{
    const NEW_STATUS = 1;
    const IN_PROCESS_STATUS = 2;
    const DONE_STATUS = 3;

    public static function getStatusLabels()
    {
        return [
            self::NEW_STATUS => 'Новая',
            self::IN_PROCESS_STATUS => 'В работе',
            self::DONE_STATUS => 'Согласована',
        ];
    }

    public static function getStatusColor($status)
    {
        switch($status){
            case self::NEW_STATUS:
                $color = 'bg-danger';
                break;
            case self::IN_PROCESS_STATUS:
                $color = 'bg-warning';
                break;
            case  self::DONE_STATUS:
                $color = 'bg-success';
                break;
            default:
                $color = 'bg-danger';
                break;
        }
        return $color;
    }

    public static function getStatusColorForCalendar($model)
    {
        $color = 'bg-danger';
        if(get_class($model) === Order::class){
            if($model->isEmpty() !== true){
                $color = 'bg-warning';
            }
            if(in_array($model->status, [self::IN_PROCESS_STATUS, self::DONE_STATUS])){
                $color = 'bg-success';
            }
        }else{
            if($model->order->status == EntityStatus::IN_PROCESS_STATUS){
                if($model->status == EntityStatus::NEW_STATUS){
                    $color = 'bg-warning';
                }else{
                    $color = 'bg-success';
                }
            }elseif($model->order->status == EntityStatus::DONE_STATUS){
                if($model->status == EntityStatus::NEW_STATUS){
                    $color = 'bg-warning';
                }else{
                    $color = 'bg-success';
                }
            }
        }




        return $color;
    }
}
