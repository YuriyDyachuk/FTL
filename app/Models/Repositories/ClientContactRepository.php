<?php

namespace App\Models\Repositories;

use App\Models\Entities\ClientContact;
use App\Models\Repositories\PhotoRepository;

class ClientContactRepository
{
    private $photoRepository;
    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    public function removeAllByClientId(int $clientId):void
    {
        ClientContact::where('client_id', '=', $clientId)->delete();
    }

    public function create(array $contactsRequest, int $clientId):void
    {
        foreach ($contactsRequest as $item) {
            $model = new ClientContact();
            $model->client_id = $clientId;
            $model->name = $item['name'];
            $model->phone = $item['phone'];
            $model->position = $item['position'];
            $model->email = $item['email'];
            if(!empty($item['photo_file'])){
                $model->photo = $this->photoRepository->updateFile($item['photo_file']);
                unset($item['photo_file']);
            }else{
                $model->photo = $item['photo'];
            }
            $model->save();
        }
    }
}
