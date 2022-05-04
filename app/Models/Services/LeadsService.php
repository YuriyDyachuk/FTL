<?php


namespace App\Models\Services;

use App\Jobs\ClientRequest\Train\CreateOrders as CreateTrainOrders;
use App\Jobs\ClientRequest\Car\CreateOrders as CreateCarOrders;
use App\Models\Entities\{ClientRequests, EntityStatus, Leads, Order};
use App\Models\Repositories\ClientRequestFtlwhFromToRepository;
use App\Models\Repositories\LeadRepository;
use App\Rules\KtkPrefix;
use App\User;
use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Validator;

class LeadsService
{
    use DispatchesJobs;

    private $leadRepository;
    private $clientRequestService;
    private $clientRequestFtlwhFromToRepository;



    public function __construct(LeadRepository $LeadRepository,
                                ClientRequestService $clientRequestService,
                                ClientRequestFtlwhFromToRepository $clientRequestFtlwhFromToRepository)
    {
        $this->leadRepository = $LeadRepository;
        $this->clientRequestService = $clientRequestService;
        $this->clientRequestFtlwhFromToRepository = $clientRequestFtlwhFromToRepository;
    }

    public function handleLeadForm(array $requestArray)
    {
        $this->updateLead($requestArray['lead']);
    }

    public function getProductsExcludeStatuses(Leads $lead, array $excludedStatuses)
    {
        $cargos = [];
        if($lead->clientRequest()->exists() && $lead->clientRequest->products()->exists()){
            $cargos = $this->leadRepository->getProductsExcludeStatuses($lead, $excludedStatuses);
        }
        return $cargos;
    }

    public function createTrOrders(array $requestArray)
    {
        $jobStatusId = null;

        $clientRequest = $this->clientRequestService->getByLeadId($requestArray['lead_id']);
        if(!empty($requestArray['clientrequest']['orderstocreate'])){
            $enableForwarding = optional($requestArray['clientrequest'])['warming'] ? true : false;
            $job = new CreateTrainOrders($requestArray, $clientRequest, $enableForwarding, Auth::id());
            $this->dispatch($job);
            $jobStatusId = $job->getJobStatusId();
        }

        return $jobStatusId;
    }

    public function createCarOrders(array $requestArray)
    {
        $jobStatusId = null;

        $client = $this->clientRequestService->getByLeadId($requestArray['lead_id']);
        if(!empty($requestArray['clientrequest']['orderstocreate'])){
            $enableForwarding = optional($requestArray['clientrequest'])['warming'] ? true : false;
            $job = new CreateCarOrders($requestArray, $client, $enableForwarding, Auth::id());
            $this->dispatch($job);
            $jobStatusId = $job->getJobStatusId();
        }

        return $jobStatusId;
    }

//    public function createOrders(array $requestArray)
//    {
//        $jobStatusId = null;
//
//        $client = $this->clientRequestService->getByLeadId($requestArray['lead_id']);
//        if(!empty($requestArray['clientrequest']['orderstocreate'])){
//            $enableForwarding = optional($requestArray['clientrequest'])['warming'] ? true : false;
//            $job = new CreateOrdersFromClientRequest($requestArray, $client, $enableForwarding, Auth::id());
//            $this->dispatch($job);
//            $jobStatusId = $job->getJobStatusId();
//        }
//        return $jobStatusId;
//    }

    private function getFromToData(array $request, string $direction)
    {
        $fromToData = $request['clientrequest'][$direction];
        $fromToContacts = $request['clientrequest'][$direction]['contacts'];
        unset($fromToData['contacts']);
        foreach ($fromToData as $n => &$item) {
            $item['contacts'] = &$fromToContacts[$n];
        }

        return $fromToData;
    }

    public function handleClientRequestsForm(array $requestArray)
    {
        $client = $this->clientRequestService->update($requestArray['clientrequest']);

        $fromData = $this->getFromToData($requestArray, 'from');
        $toData = $this->getFromToData($requestArray, 'to');

        $this->clientRequestService->updateFrom($client->id, $fromData);
        $this->clientRequestService->updateTo($client->id, $toData);
        $this->updateLeadProducts($requestArray['product'], $client->lead);
        !empty($requestArray['ftlwhFrom']) ? $this->clientRequestFtlwhFromToRepository->updateFrom($requestArray['ftlwhFrom']) : null;
    }

    public function handleClientRequestsKtkForm(array $requestArray)
    {
        $this->clientRequestFtlwhFromToRepository->updateFromShowView($requestArray['ftlwhFrom']);
    }

    private function updateLead($lead)
    {
        $this->leadRepository->update($lead);
    }

    public function updateLeadProducts($products, Leads $lead)
    {
        $this->leadRepository->removeGoods($lead);
        $this->leadRepository->createGoods($lead, $products);
    }

    public function validateForm(array $requestAll)
    {
        $rules = [];
        $messages = [];
        $rules['lead.client_id'] = 'required';
        $rules['lead.ktk_number'] = 'nullable|integer|digits:7';
        $messages['lead.ktk_number.digits'] = 'Поле КТК номер должно составлять 7 символов';
        $messages['lead.ktk_number.integer'] = 'Поле КТК номер должно быть целым числом.';

        $messages['lead.client_id.required'] = 'Поле Клиенты обязательно для заполнения';


        //$rules['lead.railway_carriage_ktk_owner'] = new KtkOwner('Поле Собственник КТК / вагона должно составлять 10 или 12 символов.');
        $rules['lead.ktk_prefix'] = new KtkPrefix();

        $validator = Validator::make($requestAll, $rules, $messages);
        return $validator->getMessageBag();
    }

    public function updatePhoto($photo)
    {
        return $this->leadRepository->updatePhoto($photo);
    }

    public function getLeadsForCurrentUser(int $leadType, User $user, array $filterData = null)
    {
        $leads = [];
        if($user->hasRole('client')){
            $leads = $this->leadRepository->getAllForCurrentClient($leadType, $user, $filterData);
        }elseif($user->hasRole('admin')){
            $leads = $this->leadRepository->getAll($leadType, $filterData);
        }else{
            $leads = $this->leadRepository->getByResponsibleUser($leadType, $user, $filterData);
        }
        return $leads;
    }

    public function createWithResponsibleUser(int $type, $userId)
    {
        return $this->leadRepository->createWithResponsibleUser($type, $userId);
    }

    public function updateStatus(Leads $lead)
    {
        $leadRelationsArray = [$lead->carRqstClWh()->get()->toArray(), $lead->carRqstTmWh()->get()->toArray(), $lead->whKtkDown()->get()->toArray(), $lead->whCross()->get()->toArray(), $lead->carWhTr()->get()->toArray(), $lead->tr()->get()->toArray(), $lead->trCross()->get()->toArray(), $lead->carWhCl()->get()->toArray(), $lead->carWhTm()->get()->toArray(), $lead->whGt()->get()->toArray(), $lead->carTrWh()->get()->toArray(), $lead->carLdcrRent()->get()->toArray()];
        $statuses = [];
        if(!empty($leadRelationsArray)){
            foreach ($leadRelationsArray as $leadRelation) {
                if(!empty($leadRelation)){
                    foreach ($leadRelation as $item) {
                        if(!empty($item) && !empty($item['status'])){
                            $statuses[] = $item['status'];
                        }
                    }
                }
            }
            if(in_array(EntityStatus::NEW_STATUS, $statuses)){
                $this->leadRepository->setStatus($lead, EntityStatus::NEW_STATUS);
            }elseif(in_array(EntityStatus::IN_PROCESS_STATUS, $statuses)){
                $this->leadRepository->setStatus($lead, EntityStatus::IN_PROCESS_STATUS);
            }else{
                $this->leadRepository->setStatus($lead, EntityStatus::DONE_STATUS);
            }
        }
    }

    public function excludeTrainOrders(?string $type)
    {
        $results = [];
        switch ($type){
            case ClientRequests::PRWH_PRWH:
                $results = [Order::CAR_TM_PROVIDER_TR_NAME, Order::TR_NAME, Order::CAR_TR_CLIENT_TM_NAME];
                break;
            case ClientRequests::PRWH_TR:
                $results = [Order::CAR_TM_PROVIDER_TR_NAME, Order::WH_GETTING_NAME, Order::WH_KTK_DOWNLOADING_NAME, Order::TR_NAME];
                break;
            case ClientRequests::PRWH_FTL:
                $results = [Order::CAR_TM_PROVIDER_TR_NAME, Order::TR_NAME, Order::CAR_TR_FTL_TM_NAME];
                break;
            case ClientRequests::TR_PRWH:
                $results = [Order::TR_NAME, Order::CAR_TR_CLIENT_TM_NAME];
                break;
            case ClientRequests::TR_FTL:
                $results = [Order::TR_NAME, Order::CAR_TR_FTL_TM_NAME];
                break;
            case ClientRequests::TR_TR:
                $results = [Order::TR_NAME];
                break;
            case ClientRequests::FTL_FTL:
                $results = [Order::WH_GETTING_NAME, Order::WH_KTK_DOWNLOADING_NAME, Order::TR_NAME, Order::CAR_TR_FTL_TM_NAME];
                break;
            case ClientRequests::FTL_TR:
                $results = [Order::WH_GETTING_NAME, Order::WH_KTK_DOWNLOADING_NAME, Order::TR_NAME];
                break;
            case ClientRequests::FTL_PRWH:
                $results = [Order::WH_GETTING_NAME, Order::WH_KTK_DOWNLOADING_NAME, Order::TR_NAME, Order::CAR_TR_CLIENT_TM_NAME];
                break;
        }
        return $results;
    }

    public function excludeCarOrders(?string $type)
    {
        $results = [];
        switch ($type){
            case ClientRequests::PRWH_PRWH:
                $results = [Order::CAR_TM_PROVIDER_TR_NAME, Order::TR_NAME, Order::CAR_TR_CLIENT_TM_NAME, Order::CAR_PROVIDER_CLIENT_NAME];
                break;
            case ClientRequests::PRWH_FTL:
                $results = [Order::CAR_TM_PROVIDER_TR_NAME, Order::TR_NAME, Order::CAR_TR_FTL_TM_NAME, Order::CAR_PROVIDER_CLIENT_NAME];
                break;
            case ClientRequests::FTL_FTL:
                $results = [Order::WH_GETTING_NAME, Order::WH_KTK_DOWNLOADING_NAME, Order::TR_NAME, Order::CAR_TR_FTL_TM_NAME, Order::CAR_PROVIDER_CLIENT_NAME];
                break;
            case ClientRequests::FTL_PRWH:
                $results = [Order::WH_GETTING_NAME, Order::WH_KTK_DOWNLOADING_NAME, Order::TR_NAME, Order::CAR_TR_CLIENT_TM_NAME, Order::CAR_PROVIDER_CLIENT_NAME];
                break;
        }
        return $results;
    }
}
