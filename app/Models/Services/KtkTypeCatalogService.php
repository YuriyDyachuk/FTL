<?php


namespace App\Models\Services;

use App\Models\Entities\KtkTypeCatalog;
use App\Models\Search\KtkTypeCatalogFilter;
use Illuminate\Http\Request;

class KtkTypeCatalogService
{
    public function filter(Request $request)
    {
        $ktkFilter = new KtkTypeCatalogFilter($request, KtkTypeCatalog::query());
        return $ktkFilter->apply();
    }
}
