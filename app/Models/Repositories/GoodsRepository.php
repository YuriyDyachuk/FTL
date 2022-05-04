<?php


namespace App\Models\Repositories;


use App\Models\Entities\Goods;

class GoodsRepository
{
    public function getById(int $id)
    {
        return Goods::find($id);
    }

    public function decrement(Goods $goods, float $weight, float $volume, int $amount)
    {
        $goods->weight -= $weight;
        $goods->volume -= $volume;
        $goods->amount -= $amount;

        $goods->save();
    }

    public function create(
        string $name,
        ?string $palletSize,
        int $downloadType,
        int $clientId,
        int $status,
        float $weight,
        float $volume,
        int $amount
    ):Goods
    {
        $model = new Goods();
        $model->name = $name;
        $model->pallet_size = $palletSize;
        $model->download_type = $downloadType;
        $model->client_id = $clientId;
        $model->status = $status;
        $model->weight = $weight;
        $model->volume = $volume;
        $model->amount = $amount;
        $model->save();

        return $model;
    }
}
