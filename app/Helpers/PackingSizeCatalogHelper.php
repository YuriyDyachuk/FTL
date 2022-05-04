<?php


namespace App\Helpers;


use App\Models\Entities\PackingSizeCatalog;
use Illuminate\Support\Arr;

class PackingSizeCatalogHelper
{
    public static function getSizes()
    {
        return Arr::pluck(PackingSizeCatalog::all(), 'size', 'id');
    }
}
