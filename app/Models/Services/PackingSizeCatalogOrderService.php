<?php


namespace App\Models\Services;

use App\Models\Repositories\PackingSizeCatalogOrderRepository;

class PackingSizeCatalogOrderService
{
    private $packingSizeCatalogOrderRepository;
    public function __construct(PackingSizeCatalogOrderRepository $packingSizeCatalogOrderRepository)
    {
        $this->packingSizeCatalogOrderRepository = $packingSizeCatalogOrderRepository;
    }

    public function updateTrainLeadPackingSizes($orderId, $packingSizes)
    {
        $this->packingSizeCatalogOrderRepository->removeAllForLeadOrder($orderId);
        foreach ($packingSizes as $packingSize) {
            if($packingSize['size'] !== null){
                $this->packingSizeCatalogOrderRepository->create($orderId, $packingSize['size']);
            }
        }
    }
}
