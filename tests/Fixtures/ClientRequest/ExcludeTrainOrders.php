<?php


namespace Tests\Fixtures\ClientRequest;


use App\Models\Entities\Order;

class ExcludeTrainOrders
{
    public static function get()
    {
        return [
            [
                'type' => 'prwh_prwh',
                'results' => [Order::CAR_TM_PROVIDER_TR_NAME, Order::TR_NAME, Order::CAR_TR_CLIENT_TM_NAME]
            ],
            [
                'type' => 'prwh_tr',
                'results' => [Order::CAR_TM_PROVIDER_TR_NAME, Order::WH_GETTING_NAME, Order::WH_KTK_DOWNLOADING_NAME, Order::TR_NAME]
            ],
            [
                'type' => 'prwh_ftl',
                'results' => [Order::CAR_TM_PROVIDER_TR_NAME, Order::TR_NAME, Order::CAR_TR_FTL_TM_NAME]
            ],
            [
                'type' => 'tr_prwh',
                'results' => [Order::TR_NAME, Order::CAR_TR_CLIENT_TM_NAME]
            ],
            [
                'type' => 'tr_ftl',
                'results' => [Order::TR_NAME, Order::CAR_TR_FTL_TM_NAME]
            ],
            [
                'type' => 'tr_tr',
                'results' => [Order::TR_NAME]
            ],
            [
                'type' => 'ftl_ftl',
                'results' => [Order::WH_GETTING_NAME, Order::WH_KTK_DOWNLOADING_NAME, Order::TR_NAME, Order::CAR_TR_FTL_TM_NAME]
            ],
            [
                'type' => 'ftl_tr',
                'results' => [Order::WH_GETTING_NAME, Order::WH_KTK_DOWNLOADING_NAME, Order::TR_NAME]
            ],
            [
                'type' => 'ftl_prwh',
                'results' => [Order::WH_GETTING_NAME, Order::WH_KTK_DOWNLOADING_NAME, Order::TR_NAME, Order::CAR_TR_CLIENT_TM_NAME]
            ],
        ];
    }
}
