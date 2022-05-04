<?php


namespace App\Models\Search;


class KtkTypeCatalogFilter extends AFilter
{
    public function name($value)
    {
        return $this->entity->where('name', 'like', "%$value%");
    }
}
