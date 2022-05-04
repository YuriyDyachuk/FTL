<?php


namespace App\Models\Repositories\Block;


use App\Models\Entities\Block;
use App\Models\Entities\Block\TerminalBlock;
use App\Models\Repositories\PhotoRepository;

class TerminalBlockRepository extends BlockRepository
{
    private $photoRepository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    public function create($orderId, ?array $data, $createDateTime = false, $createAgent = false)
    {
        $model = TerminalBlock::create(array_merge(['order_id' => $orderId], $data));

        if($createDateTime === true){
            $this->createDateTime($model->id, Block::TERMINAL_TYPE, $data['date']);
        }

        if($createAgent === true){
            $this->createAgent($model->id, Block::TERMINAL_TYPE, []);
        }
    }

    public function update(array $data)
    {
        $model = TerminalBlock::findOrFail($data['id']);
        $model->city = $data['city'];
        $model->name = $data['name'];
        $model->address = $data['address'];
        if(!empty($data['driving_scheme_file'])){
            $model->driving_scheme = $this->photoRepository->updateFile($data['driving_scheme_file']);
        }else{
            $model->driving_scheme = $data['driving_scheme'];
        }

        $model->save();
    }

}
