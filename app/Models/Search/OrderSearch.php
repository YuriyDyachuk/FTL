<?php


namespace App\Models\Search;


use App\Models\Entities\Order;
use App\Models\Repositories\OrderRepository;
use App\Models\Services\OrderService;
use Auth;

class OrderSearch extends Order
{
    private $query;
    private $parentModel;
    private $ordersService;

    public function __construct(array $attributes = [])
    {
        $this->ordersService = new OrderService(new OrderRepository());
        $this->parentModel = parent::class;
        parent::__construct($attributes);
    }

    public function search(array $params)
    {
        $defaultQuery = $this->ordersService->getCarForCurrentUser(Auth::getUser())
            ->sortable(['created_at' => 'desc'])->paginate(env('ITEMS_PER_PAGE'));
        if(empty($params)){
            return $defaultQuery;
        }
        $this->loadParams($params);

        $this->query = $this->ordersService->getCarForCurrentUser(Auth::getUser());
        $this->fillQuery();
//        dd($this->query);
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
                ->orWhere('lead_id', $this->q)
                ->orWhere('date_from', $this->q)
                ->orWhere('date_to', $this->q)
                ->orWhere('middle_date', $this->q)
                ->orWhere('client_name', $this->q)
                ->orWhere('active_resp.name', 'LIKE','%'.$this->q.'%');
        }
    }


}
