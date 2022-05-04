<?php


namespace App\Models\Repositories\Report;


use App\Models\Entities\EntityStatus;
use App\Models\Entities\Report\HeavyRentReport;

class HeavyRentRepository
{
    public function create($orderId, ?array $data)
    {
        HeavyRentReport::create(array_merge(['order_id' => $orderId], $data));
    }

    public function update($id, $data)
    {
        $model = HeavyRentReport::findOrFail($id);

        $model->toggle = !empty($data['toggle']) ? 1 : 0;
        $model->date = $data['date'];
        $model->begin_time = $data['begin_time'];
        $model->end_time = $data['end_time'];

        $model->status = EntityStatus::DONE_STATUS;

        $model->save();
    }
}
