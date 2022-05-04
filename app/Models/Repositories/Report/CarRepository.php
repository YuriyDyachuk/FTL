<?php


namespace App\Models\Repositories\Report;


use App\Models\Entities\EntityStatus;
use App\Models\Entities\Report\CarReport;
use App\Models\Repositories\PhotoRepository;

class CarRepository
{
    private $photoRepository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    public function update($id, $data)
    {
        $model = CarReport::findOrFail($id);

        $model->time = $data['time'];
        $model->is_departure = isset($data['is_departure']) ? 1 : 0;
        $model->rest_of_km = $data['rest_of_km'];
        $model->rest_of_days = $data['rest_of_days'];
        $model->other = $data['other'];

        if(!empty($data['waybill_file'])){
            $model->waybill = $this->photoRepository->updateFile($data['waybill_file']);
            unset($data['waybill_file']);
        }else{
            $model->waybill = $data['waybill'];
        }

        if(!empty($data['day_photo_file'])){
            $model->day_photo = $this->photoRepository->updateFile($data['day_photo_file']);
            unset($data['day_photo_file']);
        }else{
            $model->day_photo = $data['day_photo'];
        }

        $model->status = EntityStatus::DONE_STATUS;

        $model->save();
    }
}
