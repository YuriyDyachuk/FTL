<?php


namespace App\Models\Services;


use App\Models\Entities\PackingSizeCatalog;
use App\Models\Search\PackingSizeCatalogFilter;
use Illuminate\Http\Request;
use App\Models\Repositories\PackingSizeCatalogOrderRepository;

class PackingSizeCatalogService
{
    private $packingSizeCatalogRepository;
    public function __construct(PackingSizeCatalogOrderRepository $packingSizeCatalogRepository)
    {
        $this->packingSizeCatalogRepository = $packingSizeCatalogRepository;
    }

    public function filter(Request $request)
    {
        $sizesFilter = new PackingSizeCatalogFilter($request, PackingSizeCatalog::query());
        return $sizesFilter->apply();
    }
}
