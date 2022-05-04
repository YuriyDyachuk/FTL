<?php


namespace App\Models\Repositories\Report;


use App\Models\Entities\EntityStatus;
use App\Models\Entities\Report\PowerOfAttorneyReport;
use App\Models\Repositories\PhotoRepository;

class PowerOfAttorneyRepository
{
    private $photoRepository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    public function create($orderId, ?array $data)
    {
        PowerOfAttorneyReport::create(array_merge(['order_id' => $orderId], $data));
    }

    public function update($id, $data)
    {
        $model = $this->findById($id);

        if(!empty($data['photo_file'])){
            $model->photo = $this->photoRepository->updateFile($data['photo_file']);
        }else{
            $model->photo = $data['photo'];
        }

        $model->status = EntityStatus::DONE_STATUS;

        $model->save();
    }

    public function findById($id)
    {
        return PowerOfAttorneyReport::findOrFail($id);
    }
}
