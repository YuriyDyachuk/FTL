<?php


namespace App\Models\Services\Block;


use App\Models\Repositories\Block\{
    AgentBlockRepository,
    ClientBlockRepository,
    DateTimeBlockRepository,
    DriverBlockRepository,
    FtlBlockRepository,
    HeavyRentBlockRepository,
    ProviderBlockRepository,
    SpecCondsBlockRepository,
    TerminalBlockRepository,
    TrainBlockRepository,
    TrainOrderBlockRepository
};
use App\Models\Entities\Block;
use App\Models\Entities\Pivot\GoodsOrders;
use App\Models\Services\LeadsService;
use App\Models\Repositories\{
    LeadRepository,
    ClientRequestRepository,
    OrderRepository,
    WarehouseCargoRepository
};

class BlockService
{
    private AgentBlockRepository $agentBlockRepository;
    private ClientBlockRepository $clientBlockRepository;
    private DateTimeBlockRepository $dateTimeBlockRepository;
    private DriverBlockRepository $driverBlockRepository;
    private FtlBlockRepository $ftlBlockRepository;
    private HeavyRentBlockRepository $heavyRentBlockRepository;
    private ProviderBlockRepository $providerBlockRepository;
    private SpecCondsBlockRepository $specCondsBlockRepository;
    private TerminalBlockRepository $terminalBlockRepository;
    private TrainBlockRepository $trainBlockRepository;
    private TrainOrderBlockRepository $trainOrderBlockRepository;
    private LeadsService $leadService;
    private ClientRequestRepository $clientRequestRepository;
    private LeadRepository $leadRepository;
    private OrderRepository $orderRepository;
    private WarehouseCargoRepository $warehouseCargoRepository;

    public function __construct(
        AgentBlockRepository $agentBlockRepository,
        ClientBlockRepository $clientBlockRepository,
        DateTimeBlockRepository $dateTimeBlockRepository,
        DriverBlockRepository $driverBlockRepository,
        FtlBlockRepository $ftlBlockRepository,
        HeavyRentBlockRepository $heavyRentBlockRepository,
        ProviderBlockRepository $providerBlockRepository,
        SpecCondsBlockRepository $specCondsBlockRepository,
        TerminalBlockRepository $terminalBlockRepository,
        TrainBlockRepository $trainBlockRepository,
        TrainOrderBlockRepository $trainOrderBlockRepository,
        LeadsService $leadService,
        ClientRequestRepository $clientRequestRepository,
        LeadRepository $leadRepository,
        OrderRepository $orderRepository,
        WarehouseCargoRepository $warehouseCargoRepository
    ) {
        $this->agentBlockRepository = $agentBlockRepository;
        $this->clientBlockRepository = $clientBlockRepository;
        $this->dateTimeBlockRepository = $dateTimeBlockRepository;
        $this->driverBlockRepository = $driverBlockRepository;
        $this->ftlBlockRepository = $ftlBlockRepository;
        $this->heavyRentBlockRepository = $heavyRentBlockRepository;
        $this->providerBlockRepository = $providerBlockRepository;
        $this->specCondsBlockRepository = $specCondsBlockRepository;
        $this->terminalBlockRepository = $terminalBlockRepository;
        $this->trainBlockRepository = $trainBlockRepository;
        $this->trainOrderBlockRepository = $trainOrderBlockRepository;
        $this->leadService = $leadService;
        $this->clientRequestRepository = $clientRequestRepository;
        $this->leadRepository = $leadRepository;
        $this->orderRepository = $orderRepository;
        $this->warehouseCargoRepository = $warehouseCargoRepository;
    }

    public function updateBlock($blockType, array $data)
    {
        switch($blockType){
            case Block::CLIENT_TYPE:
                $this->clientBlockRepository->update($data);
                break;
            case Block::FTL_TYPE:
                $this->ftlBlockRepository->update($data);
                break;
            case Block::PROVIDER_TYPE:
                $this->providerBlockRepository->update($data);
                break;
            case Block::TERMINAL_TYPE:
                $this->terminalBlockRepository->update($data);
                break;
            case Block::TRAIN_TYPE:
                $this->trainBlockRepository->update($data);
                break;
            case Block::HEAVY_RENT_TYPE:
                $this->heavyRentBlockRepository->update($data);
                break;
            case Block::AGENT_TYPE:
                $this->agentBlockRepository->update($data);
                break;
            case Block::SPEC_CONDS_TYPE:
                $this->specCondsBlockRepository->update($data);
                break;
            case Block::DRIVER_TYPE:
                $this->driverBlockRepository->update($data);
                break;
            case Block::TRAIN_ORDER_TYPE:
                $this->trainOrderBlockRepository->update($data);
                break;
            case Block::DATE_TIME_TYPE:
                $this->dateTimeBlockRepository->update($data);
                break;
            case Block::SINGLE_ORDER_PRODUCTS:
                $this->updateSingleOrderProducts($data);
                break;
            case Block::PRODUCT_TYPE:
                $this->updateOrderGoods($data);
                break;
        }
    }

    private function updateSingleOrderProducts(array $data)
    {
        if(!empty($data['product'])){
            $order = $this->orderRepository->getById($data['order_id']);
            $this->orderRepository->removeGoods($order);
            $goods = $this->orderRepository->createGoods($order, $data['product']);
        }
    }

    private function updateOrderGoods(array $data)
    {
        $params = [
            'goods_id' => $data['goods_id'],
            'order_id' => $data['order_id'],
            'order_name' => $data['order_name'],
            'lead_id' => $data['lead_id'],
            'order_type' => $data['order_type']
        ];

        if(!empty($data['enabled'])){
            if(!GoodsOrders::where($params)->exists()){
                GoodsOrders::create($params);
            }
        }else{
            $query = GoodsOrders::where($params);
            if($query->exists()){
                try {
                    $query->delete();
                } catch (\Exception $e) {
                }
            }
        }
    }

}
