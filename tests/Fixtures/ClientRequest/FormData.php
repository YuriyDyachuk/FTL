<?php


namespace Tests\Fixtures\ClientRequest;


use App\Models\Entities\Client;
use App\Models\Entities\ClientRequestFrom;
use App\Models\Entities\ClientRequests;
use App\Models\Entities\EntityStatus;
use App\Models\Entities\Goods;
use App\Models\Entities\Leads;

class FormData
{
    public static function get(Leads $lead, ClientRequests $clientRequest, array $orderstocreate, array $countorderstocreate):array
    {
        return
            [
                "lead_id" => $lead->id,
                "ftlwhFrom" =>  [
                    "client_request_id" => $clientRequest->id,
                    "unl_on" => ClientRequestFrom::UNL_ON_CONTAINER,
                    "cont_type" => null,
                    "temp_mode" => null,
                    "unl_cont_ktk_type" => '20f',
                    'unl_cont_ktk_weight' => '15000',
                    'unl_cont_ktk_volume' => '10150'
                ],
                "clientrequest" =>  [
                    "id" => $clientRequest->id,
                    "status" => EntityStatus::DONE_STATUS,
                    "delivery_date" => date('d.m.Y'),
                    "from" =>  [
                        [
                            "type" => ClientRequestFrom::ADDRESS_TYPE,
                            "city" => 'Город 1',
                            "address_address" => 'адрес 1',
                            "tr_name" => null,
                            "tr_code" => null,
                            "tr_address" => null,
                            "ftl_wh" => null,
                            "pickup_power_of_attorney_number" => '1',
                            "pickup_power_of_attorney_scan" => null,
                            "driving_scheme" => null
                        ],
                        "contacts" => [
                            [
                                [
                                    "fio" => 'фио1',
                                    "phone" => '+7(000) 0000000'
                                ],
                                [
                                    "fio" => 'фио11',
                                    "phone" => '+7(111) 1111111'
                                ],
                            ]
                        ],
                    ],
                    "to" =>  [
                        [
                            "type" => ClientRequestFrom::ADDRESS_TYPE,
                            "city" => 'город 2',
                            "address_address" => 'адрес 2',
                            "tr_name" => null,
                            "tr_code" => null,
                            "tr_address" => null,
                            "ftl_wh" => null,
                            "pickup_power_of_attorney_number" => '2',
                            "pickup_power_of_attorney_scan" => null,
                            "driving_scheme" => null
                        ],
                        "contacts" =>  [
                            [
                                [
                                    "fio" => 'фио2',
                                    "phone" => '+7(222) 2222222'
                                ]
                            ]
                        ]
                    ],
                    "forwarding" =>  [
                        "warming" => null,
                        "id" => "30380",
                        "plastic_film" => null,
                        "styrofoam" => null,
                        "hardboard" => null,
                        "osb" => null,
                        "cardboard" => null,
                        "more" => null
                    ],
                    "orderstocreate" => $orderstocreate,
                    "countorderstocreate" =>  $countorderstocreate
                ],
                "product" => [
                    [
                        "name" => "test",
                        "download_type" => Goods::NAVAL_DOWNLOAD_TYPE,
                        "pallet_size" => null,
                        "status" => Goods::IN_PROCESS_STATUS,
                        "client_id" => Client::first()->id,
                        "amount" => "500",
                        "weight" => "6000",
                        "volume" => "4500"
                    ],
                    [
                        "name" => "test2",
                        "download_type" => Goods::PALLET_DOWNLOAD_TYPE,
                        "pallet_size" => "1200*80*1800",
                        "status" => Goods::IN_PROCESS_STATUS,
                        "client_id" => Client::first()->id,
                        "amount" => "1000",
                        "weight" => "9000",
                        "volume" => "5650",
                    ]
                ]
            ];
    }
}
