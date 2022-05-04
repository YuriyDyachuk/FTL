<?php


namespace App\Models\Repositories\Report;


use App\Models\Entities\Report\CargoReport;

class CargoReportRepository
{
    public function create($orderId, ?array $data)
    {
        CargoReport::create(array_merge(['order_id' => $orderId], $data));
    }
}
