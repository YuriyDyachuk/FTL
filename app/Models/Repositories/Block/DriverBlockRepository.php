<?php


namespace App\Models\Repositories\Block;

use App\Models\Entities\Block\DriverBlock;

class DriverBlockRepository extends BlockRepository
{
    public function create($orderId, ?array $data)
    {
        $model = DriverBlock::create(array_merge(['order_id' => $orderId], $data));
    }

    public function update(array $data)
    {
        $model = DriverBlock::findOrFail($data['id']);
        $model->date = $data['date'];
        $model->time = $data['time'];
        $model->fio = !empty($data['fio']) ? 1 : 0;
        $model->phone = !empty($data['phone']) ? 1 : 0;
        $model->passport_data = !empty($data['passport_data']) ? 1 : 0;
        $model->number_and_date_of_vu_delivery = !empty($data['number_and_date_of_vu_delivery']) ? 1 : 0;
        $model->mark_and_number_of_car = !empty($data['mark_and_number_of_car']) ? 1 : 0;
        $model->trailer_num = !empty($data['trailer_num']) ? 1 : 0;
        $model->save();
    }

}
