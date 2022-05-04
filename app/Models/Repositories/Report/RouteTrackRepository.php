<?php


namespace App\Models\Repositories\Report;


use App\Models\Entities\EntityStatus;
use App\Models\Entities\Report\RouteTrackReport;
use App\Models\Repositories\PhotoRepository;

class RouteTrackRepository
{
    private $photoRepository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    public function create($orderId, ?array $data)
    {
        RouteTrackReport::create(array_merge(['order_id' => $orderId], $data));
    }

    public function update($id, $data)
    {
        $model = RouteTrackReport::findOrFail($id);

        if(!empty($data['track_photo_file'])){
            $model->track_photo = $this->photoRepository->updateFile($data['track_photo_file']);
        }else{
            $model->track_photo = $data['track_photo'];
        }

        if(!empty($data['endpoint_photo_file'])){
            $model->endpoint_photo = $this->photoRepository->updateFile($data['endpoint_photo_file']);
        }else{
            $model->endpoint_photo = $data['endpoint_photo'];
        }

        if(!empty($data['waybill_photo_file'])){
            $model->waybill_photo = $this->photoRepository->updateFile($data['waybill_photo_file']);
        }else{
            $model->waybill_photo = $data['waybill_photo'];
        }

        $model->status = EntityStatus::DONE_STATUS;

        $model->save();
    }
}
