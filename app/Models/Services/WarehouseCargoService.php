<?php


namespace App\Models\Services;

use App\Models\Entities\EntityStatus;
use App\Models\Entities\GettingAct;
use App\Models\Entities\Leads;
use App\Models\Repositories\{GoodsLeadsRepository, GoodsRepository, WarehouseCargoRepository, LeadRepository};
use App\Models\Services\{LeadsService, ClientRequestService};

class WarehouseCargoService
{
    private $warehouseCargoRepository;
    private $leadsService;
    private $clientRequestService;
    private $leadRepository;
    private $goodsRepository;
    private $goodsLeadsRepository;

    public function __construct(WarehouseCargoRepository $warehouseCargoRepository,
        LeadsService $leadsService,
        ClientRequestService $clientRequestService,
        LeadRepository $leadRepository,
        GoodsRepository $goodsRepository,
        GoodsLeadsRepository $goodsLeadsRepository)
    {
        $this->warehouseCargoRepository = $warehouseCargoRepository;
        $this->leadsService = $leadsService;
        $this->clientRequestService = $clientRequestService;
        $this->leadRepository = $leadRepository;
        $this->goodsRepository = $goodsRepository;
        $this->goodsLeadsRepository = $goodsLeadsRepository;
    }

    public function importFromGettingAct(GettingAct $gettingAct, array $cargos)
    {
        if(empty($cargos)){
            return;
        }

        foreach ($cargos as $cargo) {
            $exists = $this->warehouseCargoRepository->checkExists($cargo);
            if($exists === true){
                $this->warehouseCargoRepository->synchronize($gettingAct, $cargo);
            }else{
                $this->warehouseCargoRepository->create($gettingAct, $cargo);
            }
        }
    }

    public function getAll()
    {
        return $this->warehouseCargoRepository->getAll();
    }

    public function getByIds(array $cargoIds)
    {
        return $this->warehouseCargoRepository->getByIds($cargoIds);
    }

    public function exportGoods(int $leadType, array $goods):Leads
    {
        $clientIds = [];
        $lead = $this->leadsService->createWithResponsibleUser($leadType, \Auth::getUser()->id);
        $clientRequest = $this->clientRequestService->create([
            'lead_id' => $lead->id,
            'status' => EntityStatus::NEW_STATUS,
            'active_responsible_user_id' => $lead->responsible_user_id,
            'request_date' => date('d.m.Y')
        ]);

        foreach ($goods as $goodsId => $goodsItem) {
            $goodsModel = $this->goodsRepository->getById($goodsId);
            $this->goodsRepository->decrement($goodsModel, $goodsItem['weight'], $goodsItem['volume'], $goodsItem['amount']);
            $newGoodsModel = $this->goodsRepository->create($goodsModel->name, $goodsModel->pallet_size, $goodsModel->download_type, $goodsModel->client_id, $goodsModel->status, $goodsItem['weight'], $goodsItem['volume'], $goodsItem['amount']);
            $this->goodsLeadsRepository->create($lead->id, $newGoodsModel->id);
            if(!in_array($goodsModel->client_id, $clientIds)){
                $clientIds[] = $goodsModel->client_id;
            }
        }

        $this->leadRepository->updateLeadsClients($lead, $clientIds);

        return $lead;
    }

    public function importCargo(Leads $lead, array $goods)
    {
        $clientIds = [];

        foreach ($goods as $goodsId => $goodsItem) {
            $goodsModel = $this->goodsRepository->getById($goodsId);
            $this->goodsRepository->decrement($goodsModel, $goodsItem['weight'], $goodsItem['volume'], $goodsItem['amount']);
            $newGoodsModel = $this->goodsRepository->create($goodsModel->name, $goodsModel->pallet_size, $goodsModel->download_type, $goodsModel->client_id, $goodsModel->status, $goodsItem['weight'], $goodsItem['volume'], $goodsItem['amount']);
            $this->goodsLeadsRepository->create($lead->id, $newGoodsModel->id);
            if(!in_array($goodsModel->client_id, $clientIds)){
                $clientIds[] = $goodsModel->client_id;
            }
        }
    }

    public function getByClientId(int $client_id)
    {
        return $this->warehouseCargoRepository->getByClientId($client_id);
    }

    public function getByClientIds(?array $clientIds)
    {
        return $this->warehouseCargoRepository->getByClientIds($clientIds);
    }

}
