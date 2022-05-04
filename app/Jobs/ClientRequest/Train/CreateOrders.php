<?php

namespace App\Jobs\ClientRequest\Train;

use App\Models\Entities\Block;
use App\Models\Entities\Block\DateTimeBlock;
use App\Models\Entities\Block\TrainOrderBlock;
use App\Models\Entities\ClientRequestFrom;
use App\Models\Entities\ClientRequests;
use App\Models\Entities\EntityStatus;
use App\Models\Entities\GettingActCargo;
use App\Models\Entities\Leads;
use App\Models\Entities\Order;
use App\Models\Entities\Report\CarPointReport;
use App\Models\Entities\Report\TrainReport;
use App\Models\Entities\WarehouseCargo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Repositories\OrderRepository;
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

use App\Models\Repositories\Report\{
    DriverRepository,
    CargoReportRepository,
    ForwardingRepository,
    CarPointRepository,
    WaybillRepository,
    RouteTrackRepository,
    HeavyRentRepository,
    PowerOfAttorneyRepository,
    WhGettingRepository
};
use Imtigger\LaravelJobStatus\Trackable;
use App\Models\Repositories\WarehouseCargoRepository;

class CreateOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    //public $queue = 'create_train_orders';
    //public $connection = 'database';

    private $request;
    private $clientRequest;
    private $enableForwarding;
    private $userId;

    public function __construct(
                                array $request,
                                ClientRequests $clientRequest,
                                bool $enableForwarding,
                                int $userId
    )
    {
//        $this->queue = 'create_train_orders';
//        $this->connection = 'database';
        $this->prepareStatus();
        $this->request = $request;
        $this->clientRequest = $clientRequest;
        $this->enableForwarding = $enableForwarding;
        $this->userId = $userId;
        $this->unsetFilesFromRequest();
    }


    /**
     * Execute the job.
     * @return void
     */
    public function handle(
        OrderRepository $orderRepository,
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
        DriverRepository $driverReportRepository,
        CargoReportRepository $cargoReportRepository,
        ForwardingRepository $forwardingReportRepository,
        CarPointRepository $carPointReportRepository,
        WaybillRepository $waybillReportRepository,
        RouteTrackRepository $routeTrackReportRepository,
        HeavyRentRepository $heavyRentReportRepository,
        PowerOfAttorneyRepository $powerOfAttorneyReportRepository,
        WhGettingRepository $whGettingReportRepository,
        WarehouseCargoRepository $warehouseCargoRepository
    )
    {
        $this->detachOldRelations(optional($this->clientRequest)->lead);
        $data = $this->setBlocksDataFormRequest($this->request['clientrequest']);
        //$this->clientRequest->warehouseCargos()->delete();

//        if(!empty($this->clientRequest->products()->get()->toArray()) && !empty($this->clientRequest->lead->clients)){
//            foreach ($this->clientRequest->lead->clients as $leadClient) {
//                $warehouseCargoRepository->syncWithClientRequestProducts($this->clientRequest->products()->get()->toArray(), GettingActCargo::IN_PROCESS_STATUS, $leadClient->id);
//            }
//        }

        $defaultBlock = [
            'data' => [],
            'contacts' => [],
            'date' => []
        ];

        $date = $this->request['clientrequest']['delivery_date'];

        $dateArray = [
            'date' => $date
        ];

        $emptyDateArray = [
            'date' => ''
        ];


        $defaultFtlBlock = [
            'data' => [
                'city' => Order::FTL_CITY,
                'address' => Order::FTL_ADDRESS
            ],
            'contacts' => [],
            'date' => []
        ];

        $whGtOrderIds = [];

        //$orderArrayData = $this->setArrayForAutomaticCreateOrders($this->request['lead_id'], $this->userId, EntityStatus::NEW_STATUS, $this->enableForwarding);
        $ordersCount = $this->request['clientrequest']['countorderstocreate'];
        $ordersToCreate = $this->request['clientrequest']['orderstocreate'];
        arsort($ordersToCreate);
        krsort($ordersCount);
        $max = array_sum($ordersCount);
        $this->setProgressMax($max);
        $count = 0;
        foreach ($ordersToCreate as $item) {
            switch ($item){
                case Order::CAR_HEAVY_RENT_NAME:
                    for ($i = 0; $i < intval($ordersCount[Order::CAR_HEAVY_RENT_NAME]); $i++){
                        $count++;
                        $this->setProgressNow($count);
                        $order = $orderRepository->create(
                            Order::CAR_TYPE,
                            Order::CAR_HEAVY_RENT_NAME,
                            Order::orderIndex()[Order::CAR_HEAVY_RENT_NAME] . ' ' . $this->request['lead_id'] . '-' . ($i+1),
                            $this->request['lead_id'],
                            Order::NEW_STATUS,
                            $this->userId
                        );
                        $driverBlockRepository->create($order->id, []);
                        $heavyRentBlockRepository->create($order->id, []);

                        $driverReportRepository->create($order->id, []);

                        $routeTrackReportRepository->create($order->id, []);

                        $heavyRentReportRepository->create($order->id, []);
                    }
                break;
                case Order::WH_GETTING_NAME:
                    for ($i = 0; $i < intval($ordersCount[Order::WH_GETTING_NAME]); $i++){
                        $count++;
                        $this->setProgressNow($count);
                        $order = $orderRepository->create(
                            Order::WH_TYPE,
                            Order::WH_GETTING_NAME,
                            Order::orderIndex()[Order::WH_GETTING_NAME] . ' ' . $this->request['lead_id'] . '-' . ($i+1),
                            $this->request['lead_id'],
                            Order::NEW_STATUS,
                            $this->userId
                        );
                        $whGtOrderIds[$i] = $order->id;
                        $dateTimeBlockRepository->create($order->id, DateTimeBlock::ORDER_TYPE, []);

                        $driverReportRepository->create($order->id, []);
                        $cargoReportRepository->create($order->id, []);

                        $waybillReportRepository->create($order->id, []);

                        $powerOfAttorneyReportRepository->create($order->id, []);

                        $whGettingReportRepository->create($order->id, []);
                    }
                    break;
                case Order::CAR_TM_FTL_TR_NAME:
                    for ($i = 0; $i < intval($ordersCount[Order::CAR_TM_FTL_TR_NAME]); $i++){
                        $count++;
                        $this->setProgressNow($count);
                        $order = $orderRepository->create(
                            Order::CAR_TYPE,
                            Order::CAR_TM_FTL_TR_NAME,
                            Order::orderIndex()[Order::CAR_TM_FTL_TR_NAME] . ' ' . $this->request['lead_id'] . '-' . ($i+1),
                            $this->request['lead_id'],
                            Order::NEW_STATUS,
                            $this->userId
                        );
                        $driverBlockRepository->create($order->id, []);
                        $terminalBlockRepository->create($order->id, ['date' => $dateArray], true, true);
                        $ftlBlockRepository->create($order->id, !empty($data['from']['ftl'][$i]) ? array_merge($data['from']['ftl'][$i], ['date' => $emptyDateArray]) : $defaultFtlBlock, true, true);
                        $trainBlockRepository->create($order->id, !empty($data['to']['tr'][$i]) ? array_merge($data['to']['tr'][$i], ['date' => $emptyDateArray]) : $defaultBlock, true);
                        $specCondsBlockRepository->create($order->id, []);

                        $driverReportRepository->create($order->id, []);

                        $carPointReportRepository->create($order->id, ['step' => 1]);
                        $carPointReportRepository->create($order->id, ['step' => 2]);
                        $carPointReportRepository->create($order->id, ['step' => 3]);

                        $waybillReportRepository->create($order->id, []);

                        $routeTrackReportRepository->create($order->id, []);
                    }
                break;
                case Order::CAR_TM_PROVIDER_TR_NAME:
                    for ($i = 0; $i < intval($ordersCount[Order::CAR_TM_PROVIDER_TR_NAME]); $i++){
                        $count++;
                        $this->setProgressNow($count);
                        $order = $orderRepository->create(
                            Order::CAR_TYPE,
                            Order::CAR_TM_PROVIDER_TR_NAME,
                            Order::orderIndex()[Order::CAR_TM_PROVIDER_TR_NAME] . ' ' . $this->request['lead_id'] . '-' . ($i+1),
                            $this->request['lead_id'],
                            Order::NEW_STATUS,
                            $this->userId
                        );
                        $driverBlockRepository->create($order->id, []);
                        $terminalBlockRepository->create($order->id, ['date' => $dateArray], true, true);
                        $providerBlockRepository->create($order->id, !empty($data['from']['wh'][$i]) ? array_merge($data['from']['wh'][$i], ['date' => $emptyDateArray]) : $defaultBlock, true, true);
                        $trainBlockRepository->create($order->id, !empty($data['to']['tr'][$i]) ? array_merge($data['to']['tr'][$i], ['date' => $emptyDateArray]) : $defaultBlock, true);
                        $specCondsBlockRepository->create($order->id, []);

                        $driverReportRepository->create($order->id, []);

                        $carPointReportRepository->create($order->id, ['step' => 1]);
                        $carPointReportRepository->create($order->id, ['step' => 2]);
                        $carPointReportRepository->create($order->id, ['step' => 3]);

                        $waybillReportRepository->create($order->id, []);

                        $routeTrackReportRepository->create($order->id, []);
                    }
                break;
                case Order::CAR_TR_FTL_TM_NAME:
                    for ($i = 0; $i < intval($ordersCount[Order::CAR_TR_FTL_TM_NAME]); $i++){
                        $count++;
                        $this->setProgressNow($count);
                        $order = $orderRepository->create(
                            Order::CAR_TYPE,
                            Order::CAR_TR_FTL_TM_NAME,
                            Order::orderIndex()[Order::CAR_TR_FTL_TM_NAME] . ' ' . $this->request['lead_id'] . '-' . ($i+1),
                            $this->request['lead_id'],
                            Order::NEW_STATUS,
                            $this->userId
                        );
                        $driverBlockRepository->create($order->id, []);
                        $trainBlockRepository->create($order->id, !empty($data['from']['tr'][$i]) ? array_merge($data['from']['tr'][$i], ['date' => $dateArray]) : $defaultBlock, true, true);
                        $ftlBlockRepository->create($order->id, !empty($data['from']['ftl'][$i]) ? array_merge($data['from']['ftl'][$i], ['date' => $emptyDateArray]) : $defaultFtlBlock, true, true);
                        $terminalBlockRepository->create($order->id, ['date' => $emptyDateArray], true);
                        $specCondsBlockRepository->create($order->id, []);

                        $driverReportRepository->create($order->id, []);

                        $carPointReportRepository->create($order->id, ['step' => 1]);
                        $carPointReportRepository->create($order->id, ['step' => 2]);
                        $carPointReportRepository->create($order->id, ['step' => 3]);

                        $waybillReportRepository->create($order->id, []);

                        $routeTrackReportRepository->create($order->id, []);
                    }
                break;
                case Order::CAR_TR_CLIENT_TM_NAME:
                    for ($i = 0; $i < intval($ordersCount[Order::CAR_TR_CLIENT_TM_NAME]); $i++){
                        $count++;
                        $this->setProgressNow($count);
                        $order = $orderRepository->create(
                            Order::CAR_TYPE,
                            Order::CAR_TR_CLIENT_TM_NAME,
                            Order::orderIndex()[Order::CAR_TR_CLIENT_TM_NAME] . ' ' . $this->request['lead_id'] . '-' . ($i+1),
                            $this->request['lead_id'],
                            Order::NEW_STATUS,
                            $this->userId
                        );
                        $driverBlockRepository->create($order->id, []);
                        $trainBlockRepository->create($order->id, !empty($data['from']['tr'][$i]) ? array_merge($data['from']['tr'][$i], ['date' => $dateArray]) : $defaultBlock, true, true);
                        $clientBlockRepository->create($order->id, !empty($data['to']['wh'][$i]) ? array_merge($data['to']['wh'][$i], ['date' => $emptyDateArray]) : $defaultBlock, true, true);
                        $terminalBlockRepository->create($order->id, $defaultBlock, true);
                        $specCondsBlockRepository->create($order->id, []);

                        $driverReportRepository->create($order->id, []);

                        $carPointReportRepository->create($order->id, ['step' => 1]);
                        $carPointReportRepository->create($order->id, ['step' => 2]);
                        $carPointReportRepository->create($order->id, ['step' => 3]);

                        $waybillReportRepository->create($order->id, []);

                        $routeTrackReportRepository->create($order->id, []);
                    }
                break;
                case Order::CAR_FTL_CLIENT_NAME:
                    for ($i = 0; $i < intval($ordersCount[Order::CAR_FTL_CLIENT_NAME]); $i++){
                        $count++;
                        $this->setProgressNow($count);
                        $order = $orderRepository->create(
                            Order::CAR_TYPE,
                            Order::CAR_FTL_CLIENT_NAME,
                            Order::orderIndex()[Order::CAR_FTL_CLIENT_NAME] . ' ' . $this->request['lead_id'] . '-' . ($i+1),
                            $this->request['lead_id'],
                            Order::NEW_STATUS,
                            $this->userId
                        );
                        $driverBlockRepository->create($order->id, []);
                        $ftlBlockRepository->create($order->id, !empty($data['from']['ftl'][$i]) ? array_merge($data['from']['ftl'][$i], ['date' => $dateArray]) : $defaultFtlBlock, true, true);
                        $clientBlockRepository->create($order->id, !empty($data['to']['wh'][$i]) ? array_merge($data['to']['wh'][$i], ['date' => $emptyDateArray]) : $defaultBlock, true);
                        $specCondsBlockRepository->create($order->id, []);

                        $driverReportRepository->create($order->id, []);

                        $carPointReportRepository->create($order->id, ['step' => 1]);
                        $carPointReportRepository->create($order->id, ['step' => 2]);

                        $waybillReportRepository->create($order->id, []);

                        $routeTrackReportRepository->create($order->id, []);
                    }
                break;
                case Order::CAR_FTL_TM_NAME:
                    for ($i = 0; $i < intval($ordersCount[Order::CAR_FTL_TM_NAME]); $i++){
                        $count++;
                        $this->setProgressNow($count);
                        $order = $orderRepository->create(
                            Order::CAR_TYPE,
                            Order::CAR_FTL_TM_NAME,
                            Order::orderIndex()[Order::CAR_FTL_TM_NAME] . ' ' . $this->request['lead_id'] . '-' . ($i+1),
                            $this->request['lead_id'],
                            Order::NEW_STATUS,
                            $this->userId
                        );
                        $driverBlockRepository->create($order->id, []);
                        $ftlBlockRepository->create($order->id, !empty($data['from']['ftl'][$i]) ? array_merge($data['from']['ftl'][$i], ['date' => $dateArray]) : $defaultFtlBlock, true, true);
                        $terminalBlockRepository->create($order->id, $defaultBlock, true);
                        $specCondsBlockRepository->create($order->id, []);

                        $driverReportRepository->create($order->id, []);

                        $carPointReportRepository->create($order->id, ['step' => 1]);
                        $carPointReportRepository->create($order->id, ['step' => 2]);

                        $waybillReportRepository->create($order->id, []);

                        $routeTrackReportRepository->create($order->id, []);
                    }
                break;
                case Order::CAR_WH_TR_NAME:
                    for ($i = 0; $i < intval($ordersCount[Order::CAR_WH_TR_NAME]); $i++){
                        $count++;
                        $this->setProgressNow($count);
                        $order = $orderRepository->create(
                            Order::CAR_TYPE,
                            Order::CAR_WH_TR_NAME,
                            Order::orderIndex()[Order::CAR_WH_TR_NAME] . ' ' . $this->request['lead_id'] . '-' . ($i+1),
                            $this->request['lead_id'],
                            Order::NEW_STATUS,
                            $this->userId
                        );
                        $driverBlockRepository->create($order->id, []);
                        $providerBlockRepository->create($order->id, !empty($data['from']['wh'][$i]) ? array_merge($data['from']['wh'][$i], ['date' => $dateArray]) : $defaultBlock, true);
                        $trainBlockRepository->create($order->id, !empty($data['to']['tr'][$i]) ? array_merge($data['to']['tr'][$i], ['date' => $emptyDateArray]) : $defaultBlock, true);
                        $specCondsBlockRepository->create($order->id, []);

                        $driverReportRepository->create($order->id, []);

                        $carPointReportRepository->create($order->id, ['step' => 1]);
                        $carPointReportRepository->create($order->id, ['step' => 2]);

                        $waybillReportRepository->create($order->id, []);

                        $routeTrackReportRepository->create($order->id, []);
                    }
                break;
                case Order::TR_NAME:
                    for ($i = 0; $i < intval($ordersCount[Order::TR_NAME]); $i++){
                        $count++;
                        $this->setProgressNow($count);
                        $city = $data['to']['wh'][$i]['data']['city'] ?? $data['to']['ftl'][$i]['data']['city'] ?? $data['to']['tr'][$i]['data']['city'] ?? '';
                        $order = $orderRepository->create(
                            Order::TR_TYPE,
                            Order::TR_NAME,
                            Order::orderIndex()[Order::TR_NAME] . ' ' . $this->request['lead_id'] . '-' . ($i+1),
                            $this->request['lead_id'],
                            Order::NEW_STATUS,
                            $this->userId
                        );
                        $trainOrderBlockRepository->create($order->id, ['type' => TrainOrderBlock::BEGIN_TYPE, 'date' => $date]);
                        $trainOrderBlockRepository->create($order->id, ['type' => TrainOrderBlock::END_TYPE, 'city' => $city]);
                        $this->createTrainReport($order->id, $date);
                    }
                break;
                case Order::WH_CROSS_NAME:
                    for ($i = 0; $i < intval($ordersCount[Order::WH_CROSS_NAME]); $i++){
                        $count++;
                        $this->setProgressNow($count);
                        $order = $orderRepository->create(
                            Order::WH_TYPE,
                            Order::WH_CROSS_NAME,
                            Order::orderIndex()[Order::WH_CROSS_NAME] . ' ' . $this->request['lead_id'] . '-' . ($i+1),
                            $this->request['lead_id'],
                            Order::NEW_STATUS,
                            $this->userId
                        );
                        $dateTimeBlockRepository->create($order->id, DateTimeBlock::ORDER_TYPE, []);

                        $driverReportRepository->create($order->id, []);
                    }
                break;
                case Order::WH_KTK_DOWNLOADING_NAME:
                    for ($i = 0; $i < intval($ordersCount[Order::WH_KTK_DOWNLOADING_NAME]); $i++){
                        $count++;
                        $this->setProgressNow($count);
                        $order = $orderRepository->create(
                            Order::WH_TYPE,
                            Order::WH_KTK_DOWNLOADING_NAME,
                            Order::orderIndex()[Order::WH_KTK_DOWNLOADING_NAME] . ' ' . $this->request['lead_id'] . '-' . ($i+1),
                            $this->request['lead_id'],
                            Order::NEW_STATUS,
                            $this->userId
                        );
                        $dateTimeBlockRepository->create($order->id, DateTimeBlock::ORDER_TYPE, []);

                        $driverReportRepository->create($order->id, []);
                        $forwardingReportRepository->create($order->id, []);

                        $waybillReportRepository->create($order->id, []);

                        $powerOfAttorneyReportRepository->create($order->id, []);
                    }
                break;
                case Order::CAR_PROVIDER_FTL_NAME:
                    for ($i = 0; $i < intval($ordersCount[Order::CAR_PROVIDER_FTL_NAME]); $i++){
                        $count++;
                        $this->setProgressNow($count);
                        $order = $orderRepository->create(
                            Order::CAR_TYPE,
                            Order::CAR_PROVIDER_FTL_NAME,
                            Order::orderIndex()[Order::CAR_PROVIDER_FTL_NAME] . ' ' . $this->request['lead_id'] . '-' . ($i+1),
                            $this->request['lead_id'],
                            Order::NEW_STATUS,
                            $this->userId,
                            isset($whGtOrderIds[$i]) ? $whGtOrderIds[$i] : null
                        );
                        $driverBlockRepository->create($order->id, []);
                        $providerBlockRepository->create($order->id, !empty($data['from']['wh'][$i]) && !empty($date) ? array_merge($data['from']['wh'][$i], ['date' => $dateArray]) : $defaultBlock, true, true);
                        $ftlBlockRepository->create($order->id, !empty($data['to']['ftl'][$i]) ? array_merge($data['to']['ftl'][$i], ['date' => $emptyDateArray]) : $defaultFtlBlock, true, true);
                        $specCondsBlockRepository->create($order->id, []);

                        $driverReportRepository->create($order->id, []);

                        $carPointReportRepository->create($order->id, ['step' => 1]);
                        $carPointReportRepository->create($order->id, ['step' => 2]);

                        $waybillReportRepository->create($order->id, []);

                        $routeTrackReportRepository->create($order->id, []);
                    }
                    break;
            }
        }
        $this->setOutput(['total' => $max]);
    }

    private function detachOldRelations(Leads $lead)
    {
        if($lead->orders()->exists()){
            foreach ($lead->orders as $order) {
                $order->delete();
            }
        }
    }

    private function unsetFilesFromRequest()
    {
        if(!empty($this->request['clientrequest']['from'])){
            foreach ($this->request['clientrequest']['from'] as &$from) {
                unset($from['pickup_power_of_attorney_scan_file']);
            }
        }

        if(!empty($this->request['clientrequest']['to'])){
            foreach ($this->request['clientrequest']['to'] as &$to) {
                unset($to['pickup_power_of_attorney_scan_file']);
            }
        }
    }

    private function setBlocksDataFormRequest($clientrequest):array
    {
        $fromContacts = $clientrequest['from']['contacts'];
        $toContacts = $clientrequest['to']['contacts'];
        unset($clientrequest['from']['contacts'], $clientrequest['to']['contacts']);


        $data = [
            'from' => [
                'wh' => [['data' => [], 'contacts' => []]],
                'ftl' => [['data' => [
                    'address' => Order::FTL_ADDRESS,
                    'city' => Order::FTL_CITY,
                ], 'contacts' => []]],
                'tr' => [['data' => [], 'contacts' => []]],
            ],
            'to' => [
                'wh' => [['data' => [], 'contacts' => []]],
                'ftl' => [['data' => [
                    'address' => Order::FTL_ADDRESS,
                    'city' => Order::FTL_CITY,
                ], 'contacts' => []]],
                'tr' => [['data' => [], 'contacts' => []]],
            ]
        ];

        if(!empty($clientrequest['from'])){
            $car = $wh = $tr = 0;
            foreach ($clientrequest['from'] as $c => $clientRequestDatum) {
                $numScan = ['num' => $clientRequestDatum['pickup_power_of_attorney_number'], 'scan' => $clientRequestDatum['pickup_power_of_attorney_scan']];
                $contacts = [];
                if(count($fromContacts[$c]) > 0){
                    foreach ($fromContacts[$c] as $fromContact) {
                        $contacts[] = array_merge($fromContact, $numScan);
                    }
                }
                switch ($clientRequestDatum['type']){
                    case ClientRequestFrom::ADDRESS_TYPE:
                        $data['from']['wh'][$car]['data'] = [
                            'address' => $clientRequestDatum['address_address'],
                            'city' => $clientRequestDatum['city'],
                            'driving_scheme' => $clientRequestDatum['driving_scheme']
                        ];
                        $data['from']['wh'][$car]['contacts'] = $contacts;
                        $car++;
                        break;
                    case ClientRequestFrom::FTL_WH_TYPE:
                        $data['from']['ftl'][$wh]['data'] = [
                            'address' => Order::FTL_ADDRESS, //$clientRequestDatum['ftl_wh'],
                            'city' => Order::FTL_CITY, //$clientRequestDatum['city'],
                            'driving_scheme' => $clientRequestDatum['driving_scheme']
                        ];
                        $data['from']['ftl'][$wh]['contacts'] = $contacts;
                        $wh++;
                        break;
                    case ClientRequestFrom::TRAIN_ST_TYPE:
                        $data['from']['tr'][$tr]['data'] = [
                            'name' => $clientRequestDatum['tr_name'],
                            'code' => $clientRequestDatum['tr_code'],
                            'address' => $clientRequestDatum['tr_address'],
                            'city' => $clientRequestDatum['city'],
                            'driving_scheme' => $clientRequestDatum['driving_scheme']
                        ];
                        $data['from']['tr'][$tr]['contacts'] = $contacts;
                        $tr++;
                        break;
                }
            }
        }

        if(!empty($clientrequest['to'])){
            $car = $wh = $tr = 0;
            foreach ($clientrequest['to'] as $c => $clientRequestDatum) {
                $numScan = ['num' => $clientRequestDatum['pickup_power_of_attorney_number'], 'scan' => $clientRequestDatum['pickup_power_of_attorney_scan']];
                $contacts = [];
                if(count($toContacts[$c]) > 0){
                    foreach ($toContacts[$c] as $toContact) {
                        $contacts[] = array_merge($toContact, $numScan);
                    }
                }
                switch ($clientRequestDatum['type']){
                    case ClientRequestFrom::ADDRESS_TYPE:
                        $data['to']['wh'][$car]['data'] = [
                            'address' => $clientRequestDatum['address_address'],
                            'city' => $clientRequestDatum['city'],
                            'driving_scheme' => $clientRequestDatum['driving_scheme']
                        ];
                        $data['to']['wh'][$car]['contacts'] = $contacts;
                        $car++;
                        break;
                    case ClientRequestFrom::FTL_WH_TYPE:
                        $data['to']['ftl'][$wh]['data'] = [
                            'address' => Order::FTL_ADDRESS, //$clientRequestDatum['ftl_wh'],
                            'city' => Order::FTL_CITY, //$clientRequestDatum['city'],
                            'driving_scheme' => $clientRequestDatum['driving_scheme']
                        ];
                        $data['to']['ftl'][$wh]['contacts'] = $contacts;
                        $wh++;
                        break;
                    case ClientRequestFrom::TRAIN_ST_TYPE:
                        $data['to']['tr'][$tr]['data'] = [
                            'name' => $clientRequestDatum['tr_name'],
                            'code' => $clientRequestDatum['tr_code'],
                            'address' => $clientRequestDatum['tr_address'],
                            'city' => $clientRequestDatum['city'],
                            'driving_scheme' => $clientRequestDatum['driving_scheme']
                        ];
                        $data['to']['tr'][$tr]['contacts'] = $contacts;
                        $tr++;
                        break;
                }
            }
        }

        return $data;
    }

    private function createTrainReport($orderId, $date)
    {
        for($i = 0; $i < 60; $i++){
            if($i > 0){
                $date = new \DateTime($date);
                $date->modify('+1 day');
                $date = $date->format('d.m.Y');
            }

            $model = new TrainReport();
            $model->order_id = $orderId;
            $model->date = $date;
            $model->save();
        }
    }
}
