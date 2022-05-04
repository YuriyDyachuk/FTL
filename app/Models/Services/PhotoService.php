<?php

namespace App\Models\Services;

use App\Models\Repositories\PhotoRepository;

class PhotoService
{
    private $photoRepository;
    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    public function upload(array $request)
    {
        $this->photoRepository->upload($request);
    }

    public function updateFile($file)
    {
        return $this->photoRepository->updateFile($file);
    }
}
