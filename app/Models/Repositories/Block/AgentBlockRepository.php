<?php


namespace App\Models\Repositories\Block;

use App\Models\Repositories\PhotoRepository;
use App\Models\Entities\Block\AgentBlock;

class AgentBlockRepository
{
    private $photoRepository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    public function update(array $data)
    {
        $model = AgentBlock::findOrFail($data['id']);
        $model->fio = $data['fio'];
        $model->phone = $data['phone'];
        $model->num = $data['num'];
        if(!empty($data['scan_file'])){
            $model->scan = $this->photoRepository->updateFile($data['scan_file']);
        }else{
            $model->scan = $data['scan'];
        }
        $model->save();
    }

}
