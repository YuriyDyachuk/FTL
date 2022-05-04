<?php


namespace App\Models\Search;


use App\Models\Entities\Client;

class ClientsSearchModel extends Client
{
    private $query;
    private $parentModel;

    public function __construct(array $attributes = [])
    {
        $this->parentModel = parent::class;
        parent::__construct($attributes);
    }

    public function search(array $params)
    {
        $defaultQuery = $this->parentModel::query()
            ->sortable()->paginate(env('ITEMS_PER_PAGE'));

        if(empty($params)){
            return $defaultQuery;
        }
        $this->loadParams($params);

        $this->query = $this->parentModel::query();
        $this->fillQuery();

        return $this->query->sortable()->paginate(env('ITEMS_PER_PAGE'));
    }

    private function loadParams(array $params)
    {
        foreach ($params as $key => $value){
            if(!in_array($key, ['sort', 'direction'])){
                $this->$key = $value;
            }
        }
    }

    private function fillQuery()
    {
        if(!empty($this->q)){
            $this->query
                ->orWhere('name','LIKE','%'.$this->q.'%')
                ->orWhere('inn','LIKE','%'.$this->q.'%');
        }

    }
}
