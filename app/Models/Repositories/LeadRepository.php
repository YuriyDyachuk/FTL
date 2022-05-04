<?php

namespace App\Models\Repositories;

use App\Models\Entities\Client;
use App\Models\Entities\ClientRequests;
use App\Models\Entities\ClientRequestProducts;
use App\Models\Entities\EntityStatus;
use App\Models\Entities\Goods;
use App\Models\Entities\Leads;
use App\Models\Entities\Order;
use App\Models\Entities\Pivot\GoodsLeads;
use App\Models\Entities\Pivot\GoodsOrders;
use App\Models\Entities\Pivot\LeadsClients;
use App\Models\Entities\WarehouseCargo;
use App\Models\Services\ForwardingService;
use App\User;
use DB;
use Illuminate\Database\Query\Builder;

class LeadRepository
{
    private $forwardingService;

    public function __construct(ForwardingService $forwardingService)
    {
        $this->forwardingService = $forwardingService;
    }

    public function getById(int $id)
    {
        return Leads::find($id);
    }

    public function update($lead)
    {
        $model = $this->getById($lead['id']);
        //$model->client_id = $lead['client_id'];
        $this->updateLeadsClients($model, $lead['client_id']);
        $model->status = $lead['status'];
        $model->save();
    }

    public function updateLeadsClients(Leads $lead, ?array $clientIds)
    {
        $lead->leadsClients()->delete();
        $this->addClients($lead->id, $clientIds);
    }

    private function addClients(int $leadId, ?array $clientIds)
    {
        if(!empty($clientIds)){
            foreach ($clientIds as $clientId) {
                LeadsClients::create([
                    'lead_id' => $leadId,
                    'client_id' => $clientId
                ]);
            }
        }
    }

    public function updateClientRequest($clientRequest)
    {
        $model = ClientRequests::where('id', '=', $clientRequest['id'])->first() ?: new ClientRequests();
        $model->id = $clientRequest['id'];
        $model->warming = !empty($clientRequest['warming']) && $clientRequest['warming'] == 'on' ? 1 : null;
        $model->status = $clientRequest['status'];
        if(!empty($clientRequest['forwarding_enabled'])){
            $model->forwarding_enabled = 1;
        }else{
            $model->forwarding_enabled = null;
            $model->forwarding_id = null;
        }
        $model->save();
    }

    public function updateClient(ClientRequests $clientRequest)
    {
        $model = Client::where('id', '=', $clientRequest['id'])->first();

        if(!empty($clientRequest['name'])){
            $model->name = $clientRequest['name'];
        }
        if(!empty($clientRequest['inn'])){
            $model->inn = $clientRequest['inn'];
        }
        $model->save();
    }

    public function removeGoods(Leads $lead)
    {
        $lead->goods()->delete();
    }

    public function createGoods(Leads $lead, array $products)
    {
        $createdProducts = [];
        foreach ($products as $product) {
            $productModel = Goods::create($product);
            GoodsLeads::create(['lead_id' => $lead->id, 'goods_id' => $productModel->id]);
            $createdProducts[] = $productModel;
        }

        return $createdProducts;
    }

    public function getProductsExcludeStatuses(Leads $lead, array $excludedStatuses)
    {
        $products = [];
        $clProducts = $lead->clientRequest->products;
        if(!empty($clProducts)){
            foreach ($clProducts as $clProduct) {
                if($clProduct->warehouseCargo()->whereNotIn('status', $excludedStatuses)->where('weight', '>', '0')->exists()){
                    $products[] =  $clProduct->warehouseCargo()->whereNotIn('status', $excludedStatuses)->where('weight', '>', '0')->first();
                }
            }
        }
        return $products;
    }

    public function create(int $type, int $status, int $enabled, int $userId)
    {
        return Leads::create([
            'type' => $type,
            'status' => $status,
            'enable' => $enabled,
            'responsible_user_id' => $userId
        ]);
    }

    private function syncWarehouseCargo(string $uid, array $product)
    {
        $data = $this->getWarehouseCargoColumns($product);
        if(WarehouseCargo::where('uid', $uid)->exists()){
            WarehouseCargo::where('uid', $uid)->update($data);
        }else{
            WarehouseCargo::create(array_merge(['uid' => $uid], $data));
        }
    }

    private function getWarehouseCargoColumns(array $product)
    {
        return \Arr::only($product, ['name', 'weight', 'volume', 'download_type', 'pallet_size', 'status', 'amount', 'uid']);
    }

    public function removeClientRequest($lead)
    {
        ClientRequests::where('lead_id', '=', $lead['id'])->delete();
    }

    public function updatePhoto($photo)
    {
        $imgName = $photo->hashName();
        \Storage::disk('public')->put('/images', $photo);
        return $imgName;
    }

    public function checkNullableRequest(array $data):bool
    {
        unset($data['lead_id'], $data['status'], $data['enabled']);
        foreach($data as $key => $value){
            if(!empty($value) || $value != null || $value != ""){
                return false;
                break;
            }
        }
        return true;
    }

    public function getClientRequest($lead)
    {
        return ClientRequests::where('lead_id', '=', $lead['id'])->first();
    }

    public function createWithResponsibleUser(int $type, $userId)
    {
        $model = new Leads();
        $model->responsible_user_id = $userId;
        $model->status = EntityStatus::NEW_STATUS;
        $model->type = $type;
        $model->save();

        return $model;
    }

    public function getAll(int $leadType, array $filterData = null)
    {
        $leads = Leads::with(['clientRequest', 'clientRequest.ftlWhFrom', 'clients'])
            ->where('leads.type', '=', $leadType)->enabled();


        if(!empty($filterData)){
            $this->filter($leads, $filterData);
        }

        return $leads->sortable(['created_at' => 'desc'])->paginate(env('ITEMS_PER_PAGE'));
    }

    public function getAllForCurrentClient(int $leadType, User $user, array $filterData = null)
    {
        $leads = Leads::select(['leads.*'])->join('leads_clients as lcl', 'lcl.lead_id', '=', 'leads.id')
            ->join('clients as cl', 'lcl.client_id', '=', 'cl.id')
            ->with(['clientRequest', 'clientRequest.ftlWhFrom'])
            ->where('cl.name', '=', $user->name)
            ->where('leads.type', '=', $leadType)->enabled();

        if(!empty($filterData)){
            $this->filter($leads, $filterData);
        }

        return $leads->count() > 0 ? $leads->sortable(['created_at' => 'desc'])->paginate(env('ITEMS_PER_PAGE')) : [];
    }

    public function getByResponsibleUser(int $leadType, User $user, array $filterData = null)
    {
        $leads =  Leads::with(['clientRequest', 'clientRequest.ftlWhFrom', 'clients'])
            ->select(['leads.*'])
            ->where('responsible_user_id', '=', $user->id)
            ->where('leads.type', '=', $leadType)->enabled();

        if(!empty($filterData)){
            $this->filter($leads, $filterData);
        }

        return $leads->sortable(['created_at' => 'desc'])->paginate(env('ITEMS_PER_PAGE'));
    }

    public function setStatus(Leads $lead, $status)
    {
        $lead->status = $status;
        $lead->save();
    }

    private function filter($leads, array $filterData)
    {
        foreach ($filterData as $field => $value) {
            if($field == 'client'){
                $leads->where('client_name', $value)->orWhere('client_inn', $value);
            }
            if($field == 'status'){
                $leads->where('status', $value);
            }
            if($field == 'ktk_prefix'){
                $leads->whereHas('clientRequest.ftlWhFrom', function($query)use($value){
                    return $query->where('unl_cont_ktk_prefix', $value);
                });
            }
            if($field == 'ktk_num'){
                $leads->whereHas('clientRequest.ftlWhFrom', function($query)use($value){
                    return $query->where('unl_cont_ktk_number', $value);
                });
            }
            if($field == 'created_at'){
                $date = date('d.m.Y', strtotime($value));
                $leads->whereDate('created_at', '=', $date);
            }
        }
    }

}
// select count(*) as aggregate from `leads`
// inner join `client_requests` on `client_requests`.`lead_id` = `leads`.`id`
// inner join `client_request_ftlwh_from` on `client_request_ftlwh_from`.`client_request_id` = `client_requests`.`id`
// where `client_request_ftlwh_from`.`unl_cont_ktk_prefix` = 'ASDU'
