<?php


namespace App\Models\Repositories;

use App\Http\Requests\ClientRequest;
use App\Models\Entities\ClientRequestFrom;
use App\Models\Entities\ClientRequestFromContacts;
use App\Models\Entities\ClientRequestProducts;
use App\Models\Entities\ClientRequests;
use App\Models\Entities\ClientRequestTo;
use App\Models\Entities\ClientRequestToContacts;
use App\Models\Entities\Leads;
use App\Models\Entities\WarehouseCargo;
use App\Models\Services\PhotoService;
use App\User;
use DB;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Mixed_;

class ClientRequestRepository
{
    private $forwardingRepository;
    private $photoService;

    private $orderTables = [
        'car_ldcr_rent',
        'car_rqst_cl_wh',
        'car_rqst_tm_wh',
        'car_tr_wh',
        'car_wh_cl',
        'car_wh_tm',
        'car_wh_tr',
        'tr',
        'tr_cross',
        'wh_cross',
        'wh_gt',
        'wh_ktk_down'
    ];

    public function __construct(ForwardingRepository $forwardingRepository,
                                PhotoService $photoService
                             )
    {
        $this->forwardingRepository = $forwardingRepository;
        $this->photoService = $photoService;
    }

    public function create(array $data)
    {
        return ClientRequests::create($data);
    }

    public function updateAttributes(ClientRequests $clientRequests, array $data)
    {
        return $clientRequests->update($data);
    }

    public function update($clientRequest):ClientRequests
    {
        $model = ClientRequests::where('id', '=', $clientRequest['id'])->first();
        $model->id = $clientRequest['id'];
        $model->warming = !empty($clientRequest['warming']) && $clientRequest['warming'] == 'on' ? 1 : null;
        $model->status = $clientRequest['status'];
        $model->delivery_date = $clientRequest['delivery_date'];


        $model->forwarding_enabled = 1;
        $model->forwarding_id = $this->forwardingRepository->create($clientRequest['forwarding']);

        if(!empty($clientRequest['power_of_attorney_scan_file'])){
            $model->power_of_attorney_scan = $this->photoService->updateFile($clientRequest['power_of_attorney_scan_file']);
        }
        $model->save();

        return $model;
    }

    public function getByLeadId($leadId)
    {
        return ClientRequests::where('lead_id', '=', $leadId)->first();
    }

    public function getModel($lead)
    {
        return ClientRequests::where('lead_id', '=', $lead['id'])->first();
    }

    public function removeAllFrom(int $clientId)
    {
        ClientRequestFrom::where('client_request_id', '=', $clientId)->delete();
    }

    public function removeAllTo(int $clientId)
    {
        ClientRequestTo::where('client_request_id', '=', $clientId)->delete();
    }

    public function createFrom(int $clientId, array $from)
    {
        foreach ($from as $n => $item) {
            $model = new ClientRequestFrom();
            $model->client_request_id = $clientId;
            $model->city = $item['city'] ?? null;
            $model->type = $item['type'];
            $model->address_address = $item['address_address'];
            $model->tr_name = $item['tr_name'];
            $model->tr_code = $item['tr_code'];
            $model->tr_address = $item['tr_address'] ?? null;
            $model->ftl_wh = $item['ftl_wh'];

            if (!empty($item['driving_scheme_file'])) {
                $model->driving_scheme = $this->photoService->updateFile($item['driving_scheme_file']);
            } else {
                $model->driving_scheme = $item['driving_scheme'];
            }

            $model->pickup_power_of_attorney_number = $item['pickup_power_of_attorney_number'];
            if (!empty($item['pickup_power_of_attorney_scan_file'])) {
                $model->pickup_power_of_attorney_scan = $this->photoService->updateFile($item['pickup_power_of_attorney_scan_file']);
            } else {
                $model->pickup_power_of_attorney_scan = $item['pickup_power_of_attorney_scan'];
            }

            $model->save();
            $this->removeEqualFromContacts($model->id);

            if(!empty($item['contacts'])){
                foreach($item['contacts'] as $contact){
                    $this->createFromContact($contact, $model->id);
                }
            }
        }
    }

    public function createTo(int $clientId, array $to)
    {
        foreach ($to as $n => $item) {
            $model = new ClientRequestTo();
            $model->client_request_id = $clientId;
            $model->city = $item['city'] ?? null;
            $model->type = $item['type'];
            $model->address_address = $item['address_address'];
            $model->tr_name = $item['tr_name'];
            $model->tr_code = $item['tr_code'];
            $model->tr_address = $item['tr_address'];
            $model->ftl_wh = $item['ftl_wh'] ?? null;

            if (!empty($item['driving_scheme_file'])) {
                $model->driving_scheme = $this->photoService->updateFile($item['driving_scheme_file']);
            } else {
                $model->driving_scheme = $item['driving_scheme'];
            }

            $model->pickup_power_of_attorney_number = $item['pickup_power_of_attorney_number'] ?? null;
            if (!empty($item['pickup_power_of_attorney_scan_file'])) {
                $model->pickup_power_of_attorney_scan = $this->photoService->updateFile($item['pickup_power_of_attorney_scan_file']);
            } else {
                $model->pickup_power_of_attorney_scan = $item['pickup_power_of_attorney_scan'];
            }

            $model->save();
            $this->removeEqualToContacts($model->id);

            if(!empty($item['contacts'])){
                foreach($item['contacts'] as $contact){
                    $this->createToContact($contact, $model->id);
                }
            }
        }
    }

    private function removeEqualFromContacts(int $modelId)
    {
        ClientRequestFromContacts::where('client_request_from_id', $modelId)->delete();
    }

    private function createFromContact(array $contact, int $modelId)
    {
        ClientRequestFromContacts::create(['fio' => $contact['fio'], 'phone' => $contact['phone'], 'client_request_from_id' => $modelId]);
    }

    private function removeEqualToContacts(int $modelId)
    {
        ClientRequestToContacts::where('client_request_to_id', $modelId)->delete();
    }

    private function createToContact(array $contact, int $modelId)
    {
        ClientRequestToContacts::create(['fio' => $contact['fio'], 'phone' => $contact['phone'], 'client_request_to_id' => $modelId]);
    }

    public function getAll(int $leadType)
    {
        return ClientRequests::leftJoin('leads as l', 'l.id', '=', 'client_requests.lead_id')
            ->join('leads_clients as lcl', 'lcl.lead_id', '=', 'l.id')
            ->join('clients as cl', 'lcl.client_id', '=', 'cl.id')
        ->with(['lead', 'lead.clients'])
            ->select(['client_requests.*'])->where('l.type', $leadType);
    }

    public function getOrdersForResponsibleUser(int $leadType, User $user)
    {
        $res = [];
        $leadIds = [];
        foreach ($this->orderTables as $orderTable) {
            $query = DB::table($orderTable)->where('responsible_user_id', '=', $user->id)->pluck('lead_id')->toArray();
            if(!blank($query)){
                $leadIds[] = $query;
            }
        }
        if(!blank($leadIds)){
            $res = ClientRequests::leftJoin('leads as l', 'l.id', '=', 'client_requests.lead_id')
                ->join('leads_clients as lcl', 'lcl.lead_id', '=', 'l.id')
                ->join('clients as cl', 'lcl.client_id', '=', 'cl.id')
            ->whereIn('lead_id', $leadIds)
                ->select(['client_requests.*'])->where('l.type', $leadType);
        }
        return $res;
    }

    public function getById(?string $modelId)
    {
        return ClientRequests::find($modelId);
    }

    public function setStatus(ClientRequests $model, ?string $status)
    {
        $model->status = $status;
        $model->save();
    }

    public function getByLeadIds(int $leadType, $leadIds)
    {
        return ClientRequests::leftJoin('leads as l', 'l.id', '=', 'client_requests.lead_id')
            ->join('leads_clients as lcl', 'lcl.lead_id', '=', 'l.id')
            ->join('clients as cl', 'lcl.client_id', '=', 'cl.id')
        ->whereIn('lead_id', $leadIds)
            ->select(['client_requests.*'])->where('l.type', $leadType);
    }

    public function getByLeadManager(int $leadType, int $id)
    {
        return ClientRequests::leftJoin('leads as l', 'l.id', '=', 'client_requests.lead_id')
            ->join('leads_clients as lcl', 'lcl.lead_id', '=', 'l.id')
            ->join('clients as cl', 'lcl.client_id', '=', 'cl.id')
        ->where('active_responsible_user_id', $id)
            ->select(['client_requests.*'])->where('l.type', $leadType);
    }

    public function removeEmptyProducts(Leads $leads)
    {
        if($leads->goods()->exists()){
            foreach ($leads->goods as $goodsItem) {
                if(empty($goodsItem->name)){
                    $goodsItem->delete();
                }
            }
        }
    }

    public function getProductsById($clientRequestId)
    {
        return ClientRequestProducts::where('client_request_id', $clientRequestId)->get();
    }

    public function getProductsByUid(array $cargoUids)
    {
        return ClientRequestProducts::whereIn('uid', $cargoUids)->get();
    }

    public function getProductByUid($uid):ClientRequestProducts
    {
        return ClientRequestProducts::where('uid', $uid)->first();
    }

    public function decrementProduct(ClientRequestProducts $product, $weight, $volume, $amount)
    {
        $product->weight = $product->getWeight() - str_replace(' ', '', $weight);
        $product->volume = $product->getVolume() - str_replace(' ', '', $volume);
        $product->amount -= $amount;
        $product->save();
    }

    public function setProductStatus(ClientRequestProducts $product, int $status)
    {
        $product->status = $status;
        $product->save();
    }

    public function createWarehouseCargoFromProduct(
        string $name,
        $weight,
        $volume,
        string $download_type,
        ?string $pallet_size,
        int $status,
        int $clientId,
        $amount,
        $uid,
        int $client_request_id
    ) {
        if($model = WarehouseCargo::where(['uid' => $uid, 'status' => $status])->first()){
            $model->weight = $this->addTwoStrValues($model->weight, $weight);
            $model->volume = $this->addTwoStrValues($model->volume, $volume);
            $model->amount = $this->addTwoStrValues($model->amount, $amount);
            $model->save();
        }else{
            $model = WarehouseCargo::create([
                'name' => $name,
                'weight' => $weight,
                'volume' => $volume,
                'download_type' => $download_type,
                'pallet_size' => $pallet_size,
                'status' => $status,
                'client_id' => $clientId,
                'amount' => $amount,
                'uid' => $uid,
                'client_request_id' => $client_request_id
            ]);
        }

        return $model;

    }

    private function addTwoStrValues($value1, $value2)
    {
        $value1 = str_replace(' ', '', $value1);
        $value2 = str_replace(' ', '', $value2);

        return $value1 + $value2;
    }

}
