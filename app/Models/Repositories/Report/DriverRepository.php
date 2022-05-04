<?php


namespace App\Models\Repositories\Report;


use App\Models\Entities\Report\DriverReport;

class DriverRepository
{
    public function create($orderId, ?array $data)
    {
        DriverReport::create(array_merge(['order_id' => $orderId], $data));
    }
}
