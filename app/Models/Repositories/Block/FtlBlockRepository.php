<?php


namespace App\Models\Repositories\Block;


use App\Models\Entities\Block;
use App\Models\Entities\Block\FtlBlock;
use App\Models\Repositories\PhotoRepository;

class FtlBlockRepository extends BlockRepository
{
    private $photoRepository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    public function create($orderId, ?array $data, $createDateTime = false, $createAgent = false)
    {
        $model = FtlBlock::create(array_merge(['order_id' => $orderId], $data['data']));

        if($createDateTime === true){
            $this->createDateTime($model->id, Block::FTL_TYPE, $data['date']);
        }

        if($createAgent === true){
            if(!empty($data['contacts'])){
                foreach ($data['contacts'] as $contact) {
                    $this->createAgent($model->id, Block::FTL_TYPE, $contact);
                }
            }else{
                $this->createAgent($model->id, Block::FTL_TYPE, []);
            }
        }
    }

    public function update(array $data)
    {
        $model = FtlBlock::findOrFail($data['id']);
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
