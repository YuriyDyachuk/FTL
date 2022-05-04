<?php

namespace App\Models\Services;

use App\Models\Entities\Block\DateTimeBlock;
use App\Models\Entities\EntityStatus;
use App\Models\Entities\Leads;
use App\Models\Entities\Order;
use Auth;
use App\Models\Repositories\{GoodsLeadsRepository,
    GoodsOrdersRepository,
    GoodsRepository,
    OrderRepository,
    LeadRepository,
    ClientRequestRepository,
    GettingActRepository
};
use App\User;

use App\Models\Repositories\Block\DateTimeBlockRepository;
use App\Models\Repositories\Report\{
    DriverRepository,
    CargoReportRepository,
    WaybillRepository,
    PowerOfAttorneyRepository,
    WhGettingRepository
};

class OrderService
{
    private $repository;
    private $leadRepository;
    private $clientRequestRepository;

    private $dateTimeBlockRepository;
    private $driverReportRepository;
    private $cargoReportRepository;
    private $waybillReportRepository;
    private $powerOfAttorneyReportRepository;
    private $whGettingReportRepository;
    private $goodsRepository;
    private $goodsLeadsRepository;
    private $goodsOrdersRepository;
    private $gettingActRepository;

    public function __construct(OrderRepository $repository,
                                LeadRepository $leadRepository,
                                ClientRequestRepository $clientRequestRepository,
                                DateTimeBlockRepository $dateTimeBlockRepository,
                                DriverRepository $driverReportRepository,
                                CargoReportRepository $cargoReportRepository,
                                WaybillRepository $waybillReportRepository,
                                PowerOfAttorneyRepository $powerOfAttorneyReportRepository,
                                WhGettingRepository $whGettingReportRepository,
                                GoodsRepository $goodsRepository,
                                GoodsLeadsRepository $goodsLeadsRepository,
                                GoodsOrdersRepository $goodsOrdersRepository,
                                GettingActRepository $gettingActRepository)
    {
        $this->repository = $repository;
        $this->leadRepository = $leadRepository;
        $this->clientRequestRepository = $clientRequestRepository;
        $this->dateTimeBlockRepository = $dateTimeBlockRepository;
        $this->driverReportRepository = $driverReportRepository;
        $this->cargoReportRepository = $cargoReportRepository;
        $this->waybillReportRepository = $waybillReportRepository;
        $this->powerOfAttorneyReportRepository = $powerOfAttorneyReportRepository;
        $this->whGettingReportRepository = $whGettingReportRepository;
        $this->goodsRepository = $goodsRepository;
        $this->goodsLeadsRepository = $goodsLeadsRepository;
        $this->goodsOrdersRepository = $goodsOrdersRepository;
        $this->gettingActRepository = $gettingActRepository;
    }

    public function userCanEdit(User $user, Order $model):bool
    {
        return $model->status == EntityStatus::NEW_STATUS &&
            ($model->lead->responsible_user_id == $user->id &&
            $model->active_responsible_user_id == $user->id || $user->hasRole('admin'));
    }

    public function getCarForCurrentUser(User $user, int $isSingle)
    {
        $entities = [];
        if($user->hasRole('car_chief') || $user->hasRole('admin')){
            $entities = $this->repository->getCarOrders($isSingle);
        }elseif($user->hasRole('branch_chief')){
            $entities = $this->repository->getCarOrdersForBranchChief($user->id, $isSingle);
        }elseif($user->hasRole('client')){
            $entities = $this->repository->getCarOrdersForClient($user->name, $isSingle);
        } elseif($user->can('car_edit')){
            $entities = $this->repository->getCarOrdersForResponsible($user->id, $isSingle);
        }

        return $entities;
    }

    public function getTrForCurrentUser(User $user, int $isSingle)
    {
        $entities = [];
        if($user->hasRole('tr_chief') || $user->hasRole('admin')){
            $entities = $this->repository->getTrOrders($isSingle);
        }elseif($user->hasRole('branch_chief')){
            $entities = $this->repository->getTrOrdersForBranchChief($user->id, $isSingle);
        }elseif($user->hasRole('client')){
            $entities = $this->repository->getTrOrdersForClient($user->name, $isSingle);
        } elseif($user->can('tr_edit')){
            $entities = $this->repository->getTrOrdersForResponsible($user->id, $isSingle);
        }

        return $entities;
    }

    public function getWhForCurrentUser(User $user, int $isSingle)
    {
        $entities = [];
        if($user->hasRole('wh_chief') || $user->hasRole('admin')){
            $entities = $this->repository->getWhOrders($isSingle);
        }elseif($user->hasRole('branch_chief')){
            $entities = $this->repository->getWhOrdersForBranchChief($user->id, $isSingle);
        }elseif($user->hasRole('client')){
            $entities = $this->repository->getWhOrdersForClient($user->name, $isSingle);
        } elseif($user->can('wh_edit')){
            $entities = $this->repository->getWhOrdersForResponsible($user->id, $isSingle);
        }

        return $entities;
    }

    public function createSingleOrder(int $leadType, int $type, int $name, int $status)
    {
        $userId = Auth::user()->id;
        $lead = $this->leadRepository->create($leadType, EntityStatus::NEW_STATUS, Leads::DISABLE, $userId);
        $clientRequest = $this->clientRequestRepository->create([
            'lead_id' => $lead->id,
            'status' => EntityStatus::NEW_STATUS,
            'active_responsible_user_id' => $userId
        ]);
        $orderIndex = Order::orderIndex()[Order::WH_GETTING_NAME] . ' ' . $lead->id . '-1';
        $order = $this->repository->create($type, $name, $orderIndex, $lead->id, $status, $userId, null, Order::SINGLE);

        $this->dateTimeBlockRepository->create($order->id, DateTimeBlock::ORDER_TYPE, []);
        $this->driverReportRepository->create($order->id, []);
        $this->cargoReportRepository->create($order->id, []);
        $this->waybillReportRepository->create($order->id, []);
        $this->powerOfAttorneyReportRepository->create($order->id, []);
        $this->whGettingReportRepository->create($order->id, []);
        $this->gettingActRepository->createForSingleOrder($order->id, $order->active_responsible_user_id);

        return $order;
    }

    public function bindGoodsToLead(Order $singleOrder, Leads $lead, array $goods)
    {
        $clientIds = [];

        foreach ($goods as $goodsId => $goodsItem) {
            if(!empty($goodsItem['enabled'])){
                $goodsModel = $this->goodsRepository->getById($goodsId);
                $this->goodsRepository->decrement($goodsModel, $goodsItem['weight'], $goodsItem['volume'], $goodsItem['amount']);
                $newGoodsModel = $this->goodsRepository->create($goodsModel->name, $goodsModel->pallet_size, $goodsModel->download_type, $goodsModel->client_id, $goodsModel->status, $goodsItem['weight'], $goodsItem['volume'], $goodsItem['amount']);
                $this->goodsLeadsRepository->create($lead->id, $newGoodsModel->id);
                $this->goodsOrdersRepository->create($singleOrder->id, $newGoodsModel->id, $singleOrder->name, $singleOrder->type, $lead->id);
                if(!in_array($goodsModel->client_id, $clientIds)){
                    $clientIds[] = $goodsModel->client_id;
                }
            }
        }

        $this->leadRepository->updateLeadsClients($lead, $clientIds);
    }

    public function getById(int $orderId)
    {
        return $this->repository->getById($orderId);
    }
}
