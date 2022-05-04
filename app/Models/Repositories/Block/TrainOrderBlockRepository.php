<?php


namespace App\Models\Repositories\Block;


use App\Models\Entities\Block\TrainOrderBlock;

class TrainOrderBlockRepository extends BlockRepository
{
    public function create($orderId, ?array $data)
    {
        TrainOrderBlock::create(array_merge(['order_id' => $orderId], $data));
    }

    public function update(array $data)
    {
        $model = TrainOrderBlock::findOrFail($data['id']);
        $model->order_id = $data['order_id'];
        $model->type = $data['type'];
        $model->date = $data['date'];
        $model->time = $data['time'];
        $model->city = $data['city'];
        $model->name = $data['name'];
        $model->code = $data['code'];
        $model->address = $data['address'];
        $model->fio = $data['fio'];
        $model->phone = $data['phone'];

        $model->save();
    }

}
