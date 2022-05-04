<?php


namespace App\Models\Repositories\Block;

use App\Models\Entities\Block\SpecCondsBlock;
use App\Models\Repositories\PhotoRepository;

class SpecCondsBlockRepository
{
    private $photoRepository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    public function create($orderId, ?array $data)
    {
        $model = SpecCondsBlock::create(array_merge(['order_id' => $orderId], $data));
    }

    public function update(array $data)
    {
        $model = SpecCondsBlock::findOrFail($data['id']);
        $model->description = $data['description'];
        $model->transport = $data['transport'];
        if(!empty($data['file_file'])){
            $model->file = $this->photoRepository->updateFile($data['file_file']);
        }else{
            $model->file = $data['file'];
        }

        $model->save();
    }

}
