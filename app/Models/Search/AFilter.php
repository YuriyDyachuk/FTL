<?php

namespace App\Models\Search;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class AFilter
{
    protected $request;
    protected $entity;
    public function __construct(Request $request, Builder $entity)
    {
        $this->request = $request;
        $this->entity = $entity;
    }

    public function apply()
    {
        foreach ($this->getRequestAll() as $requestItem => $requestValue) {
            if(!empty($requestValue) && method_exists($this, $requestItem)){
                $this->$requestItem($requestValue);
            }
        }
        return $this->entity;
    }

    public function getRequestAll()
    {
        return $this->request->all();
    }
}
