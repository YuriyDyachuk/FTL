<?php


namespace App\Models\Search;


class PackingSizeCatalogFilter extends AFilter
{
    public function size($value)
    {
        $this->entity->where('size', 'like', "%$value%");
    }
}
