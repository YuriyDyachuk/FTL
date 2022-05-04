<?php


namespace App\Models\Repositories\Report;


use App\Models\Entities\EntityStatus;
use App\Models\Entities\Report\WhGettingReport;
use App\Models\Repositories\PhotoRepository;

class WhGettingRepository
{
    private $photoRepository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    public function create($orderId, ?array $data)
    {
        WhGettingReport::create(array_merge(['order_id' => $orderId], $data));
    }

    public function update($id, $data)
    {
        $model = WhGettingReport::findOrFail($id);

        if(!empty($data['photo_file'])){
            $model->photo = $this->photoRepository->updateFile($data['photo_file']);
            unset($data['photo_file']);
        }else{
            $model->photo = $data['photo'];
        }

        $model->date = $data['date'];
        $model->time = $data['time'];
        $model->status = EntityStatus::DONE_STATUS;

        $model->save();
    }
}
