<?php

namespace App\Widgets;

use App\Models\Entities\EntityStatus;
use App\Models\UserManager;
use App\User;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Http\Request;

class OrderNotes extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        return view('widgets.order-notes.order_notes', [
            'config' => $this->config,
        ]);
    }

    public static function canCoordinate($model, UserManager $userManager)
    {
        $res = false;
        switch ($model['status']){
            case EntityStatus::NEW_STATUS:
                $res = true;
                break;
            case EntityStatus::IN_PROCESS_STATUS:
                if($userManager->getId() == $model->active_responsible_user_id &&
                    $userManager->getId() == $model->lead->responsible_user_id &&
                    $userManager->getId() == $model->responsible_user_id &&
                    $userManager->getId() == $model->responsible_chief_id){
                    $res = true;
                }elseif($userManager->getId() == $model->responsible_user_id){
                    //$res = self::checkReportFilled($model);
                    $res = true;
                }else{
                    $res = true;
                }
                break;
            case EntityStatus::DONE_STATUS:
                $res = false;
                break;
        }
        return $res;
    }

    public static function canAdjust(int $orderStatus, $model, UserManager $userManager)
    {
        $res = false;
        switch ($orderStatus){
            case EntityStatus::NEW_STATUS:
                switch ($userManager->getId()){
                    case $model->lead->responsible_user_id:
                        $res = false;
                        break;
                    case $model->responsible_user_id:
                        $res = true;
                        break;
                    case $model->responsible_chief_id:
                        $res = true;
                        break;
                }
                break;
            case EntityStatus::IN_PROCESS_STATUS:
            case EntityStatus::DONE_STATUS:
                switch ($userManager->getId()){
                    case $model->lead->responsible_user_id:
                        $res = true;
                        break;
                    case $model->responsible_user_id:
                        $res = false;
                        break;
                    case $model->responsible_chief_id:
                        $res = true;
                        break;
                }
                break;
        }
        return $res;
    }

    private static function checkReportFilled($model)
    {
        switch ($model->getTable()){
            case 'car_ldcr_rent':
                $res = !empty($model['date_to_photo']);
                break;
            case 'car_rqst_cl_wh':
                $res = !empty($model['date_from_photo']);
                break;
            case 'car_rqst_tm_wh':
                $res = !empty($model['date_from_photo']);
                break;
            case 'car_tm_pr_tr':
                $res = !empty($model['date_from_photo']);
                break;
            case 'car_tr_ftl_tm':
                $res = !empty($model['date_from_photo']);
                break;
            case 'car_tr_wh':
                $res = !empty($model['date_from_photo']);
                break;
            case 'car_wh_cl':
                $res = !empty($model['date_from_photo']);
                break;
            case 'car_wh_tm':
                $res = !empty($model['date_from_photo']);
                break;
            case 'car_wh_tr':
                $res = !empty($model['date_from_photo']);
                break;
            case 'tr':
                $res = !empty($model['date_from_photo']);
                break;
            case 'tr_cross':
                $res = !empty($model['date_from_photo']);
                break;
            case 'wh_cross':
                $res = !empty($model['date_from_photo']);
                break;
            case 'wh_gt':
                $res = !empty($model['date_from_photo']);
                break;
            case 'wh_ktk_down':
                $res = !empty($model['date_from_photo']);
                break;
        }

        return $res;
    }
}
