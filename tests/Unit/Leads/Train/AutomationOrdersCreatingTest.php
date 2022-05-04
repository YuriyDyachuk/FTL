<?php

namespace Tests\Unit\Leads\Train;


use App\Jobs\ClientRequest\Train\CreateOrders;
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

use App\Models\Repositories\LeadRepository;
use App\Models\Repositories\OrderRepository;
use App\Models\Repositories\WarehouseCargoRepository;
use App\Models\Repositories\Report\{
    CargoReportRepository,
    CarPointRepository,
    DriverRepository,
    ForwardingRepository,
    HeavyRentRepository,
    PowerOfAttorneyRepository,
    RouteTrackRepository,
    WaybillRepository,
    WhGettingRepository
};

use App\Models\Entities\{
    Client,
    ClientRequestFrom,
    ClientRequests,
    EntityStatus,
    Leads,
    Order,
    Role
};
use App\Models\Entities\Pivot\LeadsClients;
use App\Models\Services\LeadsService;
use App\Models\Services\WarehouseCargoService;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Queue;
use Tests\Fixtures\ClientRequest\ExcludeTrainOrders;
use Tests\Fixtures\ClientRequest\FormData;
use Tests\TestCase;

class AutomationOrdersCreatingTest extends TestCase
{
    use DatabaseTransactions;

    public function testLeadCreate()
    {
        $user = $this->createLeadsManager();

        $lead = new Leads();
        $lead->type = Leads::TR_TYPE;
        $lead->responsible_user_id = $user->id;
        $saved = $lead->save();

        $this->assertTrue($saved);

        $response = $this->actingAs($user)->get(route('leads.tr.create'));

        $response->assertStatus(302);
    }

    public function testLeadEditPage()
    {
        $this->withoutExceptionHandling();

        $user = $this->createLeadsManager();
        $lead = $this->createLead($user);

        $response = $this->actingAs($user)->get(route('leads.tr.edit', ['lead' => $lead->id], false));

        $response->assertStatus(200);
    }

    public function testCreateClientRequestWithoutLeadClients()
    {
        $user = $this->createLeadsManager();

        $lead = $this->createLead($user);

        $response = $this->actingAs($user)->get(route('clientrequests.tr.create', ['lead' => $lead]));

        $response->assertRedirect(route('leads.tr.edit', $lead));

        $this->addLeadClients($lead);

        $response = $this->actingAs($user)->get(route('clientrequests.tr.create', ['lead' => $lead]));

        $response->assertStatus(302);
    }

    public function testClientRequestEditPage()
    {
        $user = $this->createLeadsManager();
        $lead = $this->createLead($user);
        $this->addLeadClients($lead);

        $clientRequest = $this->createClientRequest($lead, $user);

        $response = $this->actingAs($user)->get(route('clientrequests.tr.edit', $clientRequest));

        $response->assertStatus(200);
    }

    public function testWarehouseCargosExists()
    {
        $user = $this->createLeadsManager();
        $lead = $this->createLead($user);
        $this->addLeadClients($lead);

        $clientRequest = $this->createClientRequest($lead, $user);


        $clientIds = $clientRequest->lead->clients->pluck('id')->toArray();
        $WarehouseCargoService = app(WarehouseCargoService::class);
        $cargos = $WarehouseCargoService->getByClientIds($clientIds);

        $this->assertInstanceOf(Collection::class, $cargos);
    }

    public function testGetImportForm()
    {
        $this->withoutExceptionHandling();

        $user = $this->createLeadsManager();
        $lead = $this->createLead($user);
        $this->addLeadClients($lead);

        $clientRequest = $this->createClientRequest($lead, $user);


        $clientIds = $clientRequest->lead->clients->pluck('id')->toArray();
        $WarehouseCargoService = app(WarehouseCargoService::class);
        $cargos = $WarehouseCargoService->getByClientIds($clientIds);

        $importFormRequest = ['ids' => json_encode($cargos->pluck('id')->toArray())];
        $response = $this->actingAs($user)->post(route('clientrequests.tr.getimportform'), $importFormRequest);

        $response->assertViewIs('clientrequests.importcargo.importForm');
    }

    public function testPickOrders()
    {
        $user = $this->createLeadsManager();

        $excludeTrainOrders = ExcludeTrainOrders::get();
        $leadsService = app(LeadsService::class);
        foreach ($excludeTrainOrders as $excludeTrainOrder) {
            $this->assertEquals($excludeTrainOrder['results'], $leadsService->excludeTrainOrders($excludeTrainOrder['type']));
        }

        $request = ['type' => $excludeTrainOrders[0]['type']];

        $response = $this->actingAs($user)->post(route('clientrequests.tr.pickorders'), $request);

        $response->assertStatus(200);
    }

    public function testCreateOrders()
    {

        //$this->withoutExceptionHandling();

        $user = $this->createLeadsManager();
        $lead = $this->createLead($user);
        $this->addLeadClients($lead);

        $clientRequest = $this->createClientRequest($lead, $user);

        $enableForwarding = optional($clientRequest['clientrequest'])['warming'] ? true : false;


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

        $countToCreate = array_sum($countorderstocreate);

        $requestData = FormData::get($lead, $clientRequest, $orderstocreate, $countorderstocreate);



        $response = $this->actingAs($user)->put(route('clientrequests.tr.validateandsave'), $requestData);

        $this->assertEquals(1, $response->getContent());

        Queue::fake();

        CreateOrders::dispatch($requestData, $clientRequest, $enableForwarding, $user->id);

        Queue::assertPushed(CreateOrders::class);

        $job = new CreateOrders($requestData, $clientRequest, $enableForwarding, $user->id);
        $job->handle(
            app(OrderRepository::class),
            app(AgentBlockRepository::class),
            app(ClientBlockRepository::class),
            app(DateTimeBlockRepository::class),
            app(DriverBlockRepository::class),
            app(FtlBlockRepository::class),
            app(HeavyRentBlockRepository::class),
            app(ProviderBlockRepository::class),
            app(SpecCondsBlockRepository::class),
            app(TerminalBlockRepository::class),
            app(TrainBlockRepository::class),
            app(TrainOrderBlockRepository::class),
            app(DriverRepository::class),
            app(CargoReportRepository::class),
            app(ForwardingRepository::class),
            app(CarPointRepository::class),
            app(WaybillRepository::class),
            app(RouteTrackRepository::class),
            app(HeavyRentRepository::class),
            app(PowerOfAttorneyRepository::class),
            app(WhGettingRepository::class),
            app(WarehouseCargoRepository::class)
        );



        $this->assertEquals($countToCreate, $lead->orders()->count());

        foreach ($orderstocreate as $item) {
            $this->assertEquals(true, $lead->orders()->where('name', $item)->exists());
        }

        $order = $lead->orders()->where('name', Order::CAR_PROVIDER_FTL_NAME)->first();

        $this->assertEquals('Город 1', $order->providerBlock->city);
        $this->assertEquals('адрес 1', $order->providerBlock->address);

        $this->assertEquals('Подольск', $order->ftlBlock->city);
        $this->assertEquals('ул. Вишнёвая, 11', $order->ftlBlock->address);

        $this->assertTrue($lead->orders()->where('name', Order::CAR_PROVIDER_FTL_NAME)->first()->driverBlock->exists());
        $this->assertTrue($order->specCondsBlock->exists());
        $this->assertTrue($order->driverReport->exists());
        $this->assertTrue($order->waybillReport->exists());
        $this->assertTrue($order->routeTrackReport->exists());

        $this->assertTrue($order->providerBlock->dateTimeBlock->exists());
        $this->assertTrue($order->ftlBlock->dateTimeBlock->exists());

        $this->assertEquals($requestData['clientrequest']['delivery_date'], $order->providerBlock->dateTimeBlock->date);
        $this->assertEmpty($order->ftlBlock->dateTimeBlock->date);

        $this->assertTrue($order->getCarPoint(1)->exists());
        $this->assertTrue($order->getCarPoint(2)->exists());

        $this->assertEquals(2, $order->providerBlock->agentBlock->count());
        $this->assertEquals(1, $order->ftlBlock->agentBlock->count());
        //$leadRepository = app(LeadRepository::class);
        //$newLead = $leadRepository->getById($lead->id);

        $this->assertTrue($lead->goods()->exists());
        $this->assertEquals(count($requestData['product']), $lead->goods->count());



        //dd(count($requestData['product']));

        //$response = $this->actingAs($user)->put(route('clientrequests.tr.createorders'), $requestData);

    }

    /**
     * @return User
     */
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

    private function createClientRequest(Leads $lead, User $user)
    {
        $client = ClientRequests::where('lead_id', $lead->id)->first() ?: new ClientRequests();
        $client->lead_id = $lead->id;
        $client->status = EntityStatus::NEW_STATUS;
        $client->active_responsible_user_id = $user->id;
        $client->save();

        return $client;
    }

}
