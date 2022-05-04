<?php


namespace App\Models\Repositories\Block;


use App\Models\Entities\Block\DateTimeBlock;

class DateTimeBlockRepository
{
    public function create($block_id, $block_type, ?array $data)
    {
        DateTimeBlock::create(array_merge(['block_id' => $block_id, 'block_type' => $block_type], $data));
    }

    public function update(array $data)
    {
        $model = DateTimeBlock::findOrFail($data['id']);
        $model->date = $data['date'];
        $model->interval = !empty($data['interval']) && $data['interval'] == 'on' ? 1 : null;
        $model->time = $data['time'];
        $model->time_from = $data['time_from'];
        $model->time_to = $data['time_to'];
        $model->save();
    }

}
