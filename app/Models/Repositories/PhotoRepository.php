<?php

namespace App\Models\Repositories;

use App\Models\Repositories\LeadRepository;

class PhotoRepository
{
    private $leadRepository;

    public function __construct(LeadRepository $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    public function upload(array $request)
    {
        $photoField = $request['photoField'];
        $model = $request['model']::find($request['id']);
        $model->$photoField = $this->leadRepository->updatePhoto($request['photo']);
        $model->save();
    }

    public function updateFile($file)
    {
        $fileName = $file->hashName();
        \Storage::disk('public')->put('/images', $file);
        return $fileName;
    }
}
