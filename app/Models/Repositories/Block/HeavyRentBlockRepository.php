<?php


namespace App\Models\Repositories\Block;


use App\Models\Entities\Block;
use App\Models\Entities\Block\HeavyRentBlock;
use App\Models\Repositories\PhotoRepository;

class HeavyRentBlockRepository extends BlockRepository
{
    private $photoRepository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    public function create($orderId, ?array $data, $createDateTime = false)
    {
        $model = HeavyRentBlock::create(array_merge(['order_id' => $orderId], $data));

        if($createDateTime === true){
            $this->createDateTime($model->id, Block::HEAVY_RENT_TYPE, []);
        }
    }

    public function update(array $data)
    {
        $model = HeavyRentBlock::findOrFail($data['id']);
        $model->address = $data['address'];
        $model->fio = $data['fio'];
        $model->phone = $data['phone'];
        $model->place_weight = $data['place_weight'];
        $model->place_size = $data['place_size'];
        if(!empty($data['cargo_photo_file'])){
            $model->cargo_photo = $this->photoRepository->updateFile($data['cargo_photo_file']);
        }else{
            $model->cargo_photo = $data['cargo_photo'];
        }

        $model->begin_date = $data['begin_date'];
        $model->begin_time = $data['begin_time'];
        $model->begin_time_interval = !empty($data['begin_time_interval']) ? 1 : 0;
        $model->begin_time_from = $data['begin_time_from'];
        $model->begin_time_to = $data['begin_time_to'];

        $model->end_date = $data['end_date'];
        $model->end_time = $data['end_time'];
        $model->end_time_interval = !empty($data['end_time_interval']) ? 1 : 0;
        $model->end_time_from = $data['end_time_from'];
        $model->end_time_to = $data['end_time_to'];

        $model->save();

    }

}
