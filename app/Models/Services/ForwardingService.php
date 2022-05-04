<?php


namespace App\Models\Services;

use App\Models\Repositories\ForwardingRepository;

class ForwardingService
{
    private $forwardingRepository;
    public function __construct(ForwardingRepository $forwardingRepository)
    {
        $this->forwardingRepository = $forwardingRepository;
    }

    public function create(array $request)
    {
        $modelInfo = $request['model'];
        unset($request['model']);
        $this->forwardingRepository->delete($modelInfo['class'], $modelInfo['id'], $request['id']);
        if($forwardingId = $this->forwardingRepository->create($request)){
            $this->forwardingRepository->updateModel($modelInfo['class'], $modelInfo['id'], $forwardingId);
            return 1;
        }
    }

    public function createFromClientRequest(array $request)
    {
        return $this->forwardingRepository->create($request);
    }
}
