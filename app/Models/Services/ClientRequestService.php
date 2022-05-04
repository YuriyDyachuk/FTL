<?php


namespace App\Models\Services;

use App\Models\Entities\ClientRequestFrom;
use App\Models\Entities\ClientRequests;
use App\Models\Entities\GettingActCargo;
use App\Models\Entities\Leads;
use App\Models\Repositories\ClientRequestRepository;
use App\User;
use App\Models\Repositories\WarehouseCargoRepository;
use Illuminate\Database\Eloquent\Builder;
use Validator;

class ClientRequestService
{
    private $clientRequestRepository;
    private $warehouseCargoRepository;

    public function __construct(ClientRequestRepository $clientRequestRepository, WarehouseCargoRepository $warehouseCargoRepository)
    {
        $this->clientRequestRepository = $clientRequestRepository;
        $this->warehouseCargoRepository = $warehouseCargoRepository;
    }

    public function getDeliveryTypeViewNameById(?string $typeId):string
    {
        switch($typeId){
            case ClientRequestFrom::ADDRESS_TYPE:
                $viewName = 'address';
                break;
            case ClientRequestFrom::FTL_WH_TYPE:
                $viewName = 'ftlwh';
                break;
            case ClientRequestFrom::TRAIN_ST_TYPE:
                $viewName = 'trainst';
                break;
            default:
                $viewName = '';
                break;
        }
        return $viewName;
    }

    public function create(array $data)
    {
        return $this->clientRequestRepository->create($data);
    }

    public function getUnloadingDataViewNameById(?string $typeId):string
    {
        switch($typeId){
            case ClientRequestFrom::UNL_ON_CONTAINER:
                $viewName = 'unlcontainer';
                break;
            case ClientRequestFrom::UNL_ON_RAIL_CARR:
                $viewName = 'unlrailcarr';
                break;
            default:
                $viewName = '';
                break;
        }
        return $viewName;
    }

    public function getContainerPlaceDataViewNameById(?string $typeId):string
    {
        switch($typeId){
            case ClientRequestFrom::CONT_PLACE_TM:
                $viewName = 'terminal';
                break;
            case ClientRequestFrom::CONT_PLACE_PICKUP:
                $viewName = 'pickup';
                break;
            default:
                $viewName = '';
                break;
        }
        return $viewName;
    }

    public function update($clientRequest)
    {
        return $this->clientRequestRepository->update($clientRequest);
    }

    public function updateFrom(int $clientId, ?array $from = null)
    {
        $this->clientRequestRepository->removeAllFrom($clientId);
        if(!empty($from)){
            $this->clientRequestRepository->createFrom($clientId, $from);
        }
    }

    public function updateTo(int $clientId, ?array $to = null)
    {
        $this->clientRequestRepository->removeAllTo($clientId);
        if(!empty($to)){
            $this->clientRequestRepository->createTo($clientId, $to);
        }
    }

    public function validateForm(array $request)
    {
        $rules = [];
        $messages = [];
        $validator = Validator::make($request, $rules, $messages);
        $messageBag = $validator->getMessageBag();
        $messageBag->merge($this->validateFtlwhFromRequest($request['ftlwhFrom']));
        return $messageBag;
    }

    private function validateFtlwhFromRequest($ftlwhFromRequest)
    {
        $rules = [];
        $messages = [];

        $rules['tm_code'] = 'nullable|integer';
        $messages['tm_code'] = 'Поле Код терминала на терминале должно быть целым числом.';

        $validator = Validator::make($ftlwhFromRequest, $rules, $messages);
      //  $messageBag = $validator->getMessageBag();
        return $validator;
    }

    public function getLeadsForCurrentUser(int $leadType, User $user, $filterValue = null)
    {
        $entities = [];
        if($user->hasRole('client')){
            $leadIds = optional($user->client)->lead->pluck('id');
            if(!blank($leadIds)){
                $entities = $this->clientRequestRepository->getByLeadIds($leadType, $leadIds);
            }
        }elseif($user->hasRole(['admin', 'tr_chief', 'car_chief', 'wh_chief', 'pgt_chief'])){
            $entities = $this->clientRequestRepository->getAll($leadType);

        }elseif($user->hasRole('lead_manager')){
            $entities = $this->clientRequestRepository->getByLeadManager($leadType, $user->id);
        }else{
            $entities = $this->clientRequestRepository->getOrdersForResponsibleUser($leadType, $user);
        }
        if(!empty($filterValue)){
            $entities = $this->filterEntities($entities, $filterValue);
        }

        return $entities->sortable(['created_at' => 'desc'])->paginate(env('ITEMS_PER_PAGE'));
    }

    private function filterEntities(Builder $entities, $filterValue)
    {
        return $entities->where('lead_id', $filterValue)
            ->orWhere('clients.name', 'like', "%$filterValue%")
            ->orWhere(\DB::raw("date(client_requests.created_at)"), $filterValue);
    }

    public function setStatus(?string $modelId, ?string $status)
    {
        $model = $this->clientRequestRepository->getById($modelId);
        $this->clientRequestRepository->setStatus($model, $status);
        return $model;
    }

    public function getById($id)
    {
        return $this->clientRequestRepository->getById($id);
    }

    public function getByLeadId($leadId):ClientRequests
    {
        return $this->clientRequestRepository->getByLeadId($leadId);
    }

    public function removeEmptyProducts(Leads $lead)
    {
        $this->clientRequestRepository->removeEmptyProducts($lead);
    }

    public function getProductsById(int $clientRequestId)
    {
        return $this->clientRequestRepository->getProductsById($clientRequestId);
    }

    public function getProductsByUid(array $cargoUids)
    {
        return $this->clientRequestRepository->getProductsByUid($cargoUids);
    }

    public function decrementProduct(array $data)
    {
        $product = $this->clientRequestRepository->getProductByUid($data['uid']);
        $warehouseCargo = $this->warehouseCargoRepository->getByUid($data['uid']);
        if(!empty($warehouseCargo)){
            $this->warehouseCargoRepository->decrementCargoValues($product->client_request_id, $warehouseCargo, $data);
        }
        if(!empty($product)){
            $this->clientRequestRepository->decrementProduct($product, $data['weight'], $data['volume'], $data['amount']);
            $this->clientRequestRepository->setProductStatus($product, GettingActCargo::IN_THE_CONTAINER_STATUS);
        }
    }

    public function createWarehouseCargoFromProduct(array $data)
    {
        $product = $this->clientRequestRepository->getProductByUid($data['uid']);
        if(!empty($product)){
            $clientId = $product->clientRequest->lead->client_id;
            $this->clientRequestRepository->createWarehouseCargoFromProduct($product->name, $data['weight'], $data['volume'], $product->download_type, $product->pallet_size, GettingActCargo::IN_THE_CONTAINER_STATUS, $clientId, $data['amount'], $data['uid'], $product->client_request_id);
        }
    }

    public function updateByLeadIdOrCreate(int $leadId, int $status, int $userId):ClientRequests
    {
        if($clientRequest = $this->clientRequestRepository->getByLeadId($leadId)){
            $this->clientRequestRepository->updateAttributes($clientRequest, ['status' => $status, 'active_responsible_user_id' => $userId]);
        }else{
            $clientRequest = $this->clientRequestRepository->create(['lead_id' => $leadId, 'status' => $status, 'active_responsible_user_id' => $userId]);
        }

        return $clientRequest;
    }
}
