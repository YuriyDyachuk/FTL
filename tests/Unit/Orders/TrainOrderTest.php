<?php

namespace Tests\Unit\Orders;

use App\Models\Entities\{
    Block,
    Client,
    ClientRequests,
    EntityStatus,
    Leads,
    Order,
    Role
};
use App\Models\Entities\Block\TrainOrderBlock;
use App\Models\Entities\Pivot\LeadsClients;
use App\Models\Repositories\Block\TrainOrderBlockRepository;
use App\Models\Repositories\LeadRepository;
use App\Models\Repositories\OrderRepository;
use App\Models\Services\OrderService;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Fixtures\ClientRequest\FormData;
use Tests\TestCase;

class TrainOrderTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreate()
    {
        $leadManager = $this->createLeadsManager();
        $trainWorker = $this->createTrainWorker();

        $order = $this->createOrder($leadManager, $trainWorker);

        $this->assertEquals(2, $order->getAllOrderGoods()->count());

        $this->assertInstanceOf(get_class($order), new Order());
    }

    public function testEdit()
    {
        $this->withoutExceptionHandling();

        $leadManager = $this->createLeadsManager();
        $trainWorker = $this->createTrainWorker();
        $order = $this->createOrder($leadManager, $trainWorker);

        $response = $this->actingAs($leadManager)->get(route('order.edit', $order));

        $response->assertViewIs('order.edit');

        $allOrderGoods = $order->getAllOrderGoods();

        $this->assertEmpty($order->getCurrentOrderGoods());
        $this->assertNotEmpty($allOrderGoods);

        $blockServiceRequestData = [
            'goods_id' => $allOrderGoods->first()->id,
            'order_id' => $order->id,
            'order_name' => $order->name,
            'lead_id' => $order->lead_id,
            'order_type' => $order->type,
            'enabled' => true,
            'blocktype' => Block::PRODUCT_TYPE
        ];

        $response = $this->actingAs($leadManager)->put(route('order.updateblock'), $blockServiceRequestData);

        $this->assertEquals(1, $response->getContent());

        $this->assertEquals(1, $order->getCurrentOrderGoods()->count());

        $orderService = app(OrderService::class);

        $this->assertFalse($orderService->userCanEdit($trainWorker, $order));

        $orderNotes = 'Order test note';

        $orderValidateAndSaveRequest = [
            'id' => $order->id,
            'responsible_user_id' => $leadManager->id,
            'responsible_chief_id' => $leadManager->id,
            'responsible_branch_chief_id' => $leadManager->id,
            'notes' => $orderNotes
        ];
        $orderValidateAndSaveResponse = $this->actingAs($leadManager)->put(route('order.validateandsave'), $orderValidateAndSaveRequest);

        $this->assertEquals(1, $orderValidateAndSaveResponse->getContent());

        $orderRepository = app(OrderRepository::class);

        $updatedOrder = $orderRepository->getById($order->id);

        $this->assertEquals($orderNotes, $updatedOrder->notes);
    }

    private function createOrder(User $leadManager, User $trainWorker):Order
    {
        $lead = $this->createLead($leadManager);
        $this->addLeadClients($lead);

        $orderstocreate = [
            0 => Order::CAR_PROVIDER_FTL_NAME,
            1 => Order::WH_GETTING_NAME,
            2 => Order::WH_KTK_DOWNLOADING_NAME,
            3 => Order::CAR_TM_FTL_TR_NAME,
            4 => Order::TR_NAME,
            5 => Order::CAR_TR_CLIENT_TM_NAME,
        ];

        $countorderstocreate = [
            Order::CAR_PROVIDER_FTL_NAME => "1",
            Order::WH_GETTING_NAME => "1",
            Order::WH_KTK_DOWNLOADING_NAME => "1",
            Order::CAR_TM_FTL_TR_NAME => "1",
            11 => "0",
            4 => "0",
            Order::TR_NAME => "1",
            5 => "0",
            Order::CAR_TR_CLIENT_TM_NAME => "1",
            7 => "0",
            8 => "0",
            1 => "0",
        ];

        $clientRequest = $this->createClientRequest($lead, $trainWorker);
        $leadRepository = app(LeadRepository::class);
        $formData = FormData::get($lead, $clientRequest, $orderstocreate, $countorderstocreate);
        $leadRepository->createGoods($lead, $formData['product']);

        $orderRepository = app(OrderRepository::class);
        $orderType = Order::TR_TYPE;
        $orderName = Order::TR_NAME;
        $orderIndex = Order::orderIndex()[$orderName] . $lead->id . '-1';
        $orderStatus = EntityStatus::NEW_STATUS;

        $order = $orderRepository->create($orderType, $orderName, $orderIndex, $lead->id, $orderStatus, $trainWorker->id);

        $trainOrderBlockRepository = app(TrainOrderBlockRepository::class);

        $trainOrderBlockRepository->create($order->id, ['type' => TrainOrderBlock::BEGIN_TYPE]);
        $trainOrderBlockRepository->create($order->id, ['type' => TrainOrderBlock::END_TYPE]);

        return $order;
    }

    private function createClientRequest(Leads $lead, User $user)
    {
        $client = ClientRequests::where('lead_id', $lead->id)->first() ?: new ClientRequests();
        $client->lead_id = $lead->id;
        $client->status = EntityStatus::NEW_STATUS;
        $client->active_responsible_user_id = $user->id;
        $client->save();

        return $client;
    }

    public function createLeadsManager():User
    {
        $user = factory(User::class)->create();

        $role = Role::where('name', 'lead_manager')->first();
        $user->attachRole($role->id);

        return $user;
    }

    /**
     * @param  User  $user
     * @return Leads
     */
    private function createLead(User $user):Leads
    {
        $lead = new Leads();
        $lead->type = Leads::TR_TYPE;
        $lead->responsible_user_id = $user->id;
        $lead->save();

        return $lead;
    }

    private function addLeadClients(Leads $lead)
    {
        $clients = Client::limit(8)->get();
        foreach ($clients as $client) {
            LeadsClients::create([
                'lead_id' => $lead->id,
                'client_id' => $client->id
            ]);
        }
    }

    private function createTrainWorker():User
    {
        $user = factory(User::class)->create();

        $role = Role::where('name', 'tr_logistics')->first();
        $user->attachRole($role->id);

        return $user;
    }

}
