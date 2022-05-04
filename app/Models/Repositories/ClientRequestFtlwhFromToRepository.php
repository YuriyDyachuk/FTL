<?php


namespace App\Models\Repositories;


use App\Models\Entities\ClientRequestFtlwhFrom;
use App\Models\Entities\ClientRequestFtlwhTo;
use App\Models\Services\PhotoService;


class ClientRequestFtlwhFromToRepository
{
    private $photoService;
    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    public function updateFrom(array $request)
    {
        $model = ClientRequestFtlwhFrom::where('client_request_id', '=', $request['client_request_id'])->first() ?: new ClientRequestFtlwhFrom();
        $this->collectData($model, $request);
        $model->save();
    }

    public function updateFromShowView(array $request)
    {
        $model = ClientRequestFtlwhFrom::where('client_request_id', '=', $request['client_request_id'])->first() ?: new ClientRequestFtlwhFrom();
        $model->unl_cont_ktk_prefix = $request['unl_cont_ktk_prefix'];
        $model->unl_cont_ktk_number = $request['unl_cont_ktk_number'];
        $model->save();
    }

    public function updateTo(array $request)
    {
        $model = ClientRequestFtlwhTo::where('client_request_id', '=', $request['client_request_id'])->first() ?: new ClientRequestFtlwhTo();
        $this->collectData($model, $request);
        $model->save();
    }

    private function collectData($model, array $request)
    {
//        if(!empty($request['unl_date'])){
//            $model->unl_date = $request['unl_date'];
//        }
        $model->client_request_id = $request['client_request_id'];
        $model->unl_on = $request['unl_on'];
        $model->unl_cont_ktk_type = $request['unl_cont_ktk_type'];
     //   $model->unl_cont_ktk_prefix = $request['unl_cont_ktk_prefix'];
     //   $model->unl_cont_ktk_number = $request['unl_cont_ktk_number'];
    //    $model->unl_cont_ktk_owner_name = $request['unl_cont_ktk_owner_name'];
     //   $model->unl_cont_ktk_owner_inn = $request['unl_cont_ktk_owner_inn'];
        $model->client_has_container = !empty($request['client_has_container']) && $request['client_has_container'] == 'on' ? 1 : null;
 //       $model->client_container_place = $request['client_container_place'];
   //     $model->pickup_name = $request['pickup_name'];
    //    $model->pickup_code = $request['pickup_code'];
     //   $model->pickup_city = $request['pickup_city'];
      //  $model->pickup_address = $request['pickup_address'];
      //  $model->pickup_power_of_attorney_number = $request['pickup_power_of_attorney_number'];
        //$model->tm_name = $request['tm_name'];
        //$model->tm_code = $request['tm_code'];
        //$model->tm_city = $request['tm_city'];
        //$model->tm_address = $request['tm_address'];
        //$model->tm_power_of_attorney_number = $request['tm_power_of_attorney_number'];
//        $model->unl_tr_name = $request['unl_tr_name'];
//        $model->unl_tr_code = $request['unl_tr_code'];
//        $model->unl_tr_address = $request['unl_tr_address'];
//        $model->unl_tr_railway_carriage_owner_name = $request['unl_tr_railway_carriage_owner_name'];
//        $model->unl_tr_railway_carriage_owner_inn = $request['unl_tr_railway_carriage_owner_inn'];
//        $model->tm_power_of_attorney_scan = $request['tm_power_of_attorney_scan'];
//        if(!empty($request['tm_power_of_attorney_scan_file'])){
//            $model->tm_power_of_attorney_scan =  $this->photoService->updateFile($request['tm_power_of_attorney_scan_file']);
//        }
        $model->cont_type = $request['cont_type'];
        $model->temp_mode = $request['temp_mode'];
       // $model->ftl_wh = $request['ftl_wh'];

        $model->unl_cont_ktk_weight = $request['unl_cont_ktk_weight'];
        $model->unl_cont_ktk_volume = $request['unl_cont_ktk_volume'];
    }
}
