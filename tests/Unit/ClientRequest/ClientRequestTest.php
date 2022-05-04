<?php

namespace Tests\Unit\ClientRequest;

use App\Models\Entities\Client;
use App\Models\Entities\ClientRequestFrom;
use App\Models\Entities\ClientRequests;
use App\Models\Entities\EntityStatus;
use App\Models\Entities\Goods;
use App\Models\Entities\Leads;
use App\Models\Entities\Order;
use App\Models\Entities\Pivot\LeadsClients;
use App\Models\Entities\Role;
use App\Models\Repositories\ClientRequestRepository;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Fixtures\ClientRequest\FormData;
use Tests\TestCase;

class ClientRequestTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreate()
    {
        $user = $this->createLeadsManager();

        foreach(Leads::typesList() as $type){
            if($type === Leads::WH_TYPE){
                continue;
            }
            $lead = $this->createLead($user, $type);

            $response = $this->actingAs($user)->get(route('clientrequests.'.$lead->getShortLabel().'.create', ['lead' => $lead]));

            $response->assertRedirect(route('leads.'.$lead->getShortLabel().'.edit', $lead));
            $this->addLeadClients($lead);
            $response = $this->actingAs($user)->get(route('clientrequests.'.$lead->getShortLabel().'.create', ['lead' => $lead]));
            $response->assertStatus(302);
        }

    }

    public function testEdit()
    {
        $user = $this->createLeadsManager();
        foreach (Leads::typesList() as $type) {
            if($type === Leads::WH_TYPE){
                continue;
            }
            $lead = $this->createLead($user, $type);
            $this->addLeadClients($lead);

            $clientRequest = $this->createClientRequest($lead, $user);

            $response = $this->actingAs($user)->get(route('clientrequests.'.$lead->getShortLabel().'.edit', $clientRequest));
            $response->assertStatus(200);
        }

    }

    public function testUpdate()
    {
        $user = $this->createLeadsManager();
        $orderstocreate = [
            0 => Order::CAR_PROVIDER_FTL_NAME,
            1 => Order::WH_GETTING_NAME,
            2 => Order::WH_KTK_DOWNLOADING_NAME,
            3 => Order::CAR_TM_FTL_TR_NAME,
            5 => Order::CAR_TR_CLIENT_TM_NAME,
        ];

        $countorderstocreate =  [
            Order::CAR_PROVIDER_FTL_NAME => "1",
            Order::WH_GETTING_NAME => "1",
            Order::WH_KTK_DOWNLOADING_NAME => "1",
            Order::CAR_TM_FTL_TR_NAME => "1",
            11 => "0",
            4 => "0",
            10 => "0",
            5 => "0",
            Order::CAR_TR_CLIENT_TM_NAME => "1",
            7 => "0",
            8 => "0",
            1 => "0",
        ];

        foreach (Leads::typesList() as $type) {
            if($type === Leads::WH_TYPE){
                continue;
            }
            $lead = $this->createLead($user, $type);
            $this->addLeadClients($lead);

            $clientRequest = $this->createClientRequest($lead, $user);
            $date = date('d.m.Y');
            $requestData = FormData::get($lead, $clientRequest, $orderstocreate, $countorderstocreate);

            $this->assertEquals($date, $clientRequest->request_date);
            $date = date('d.m.Y', strtotime('+1 days'));

            $requestData['clientrequest']['delivery_date'] = $date;


            $response = $this->actingAs($user)->put(route('clientrequests.'.$lead->getShortLabel().'.validateandsave'), $requestData);

            $clientRequestId = $clientRequest->id;

            $clientRequestRepository = app(ClientRequestRepository::class);

            $clientRequest = $clientRequestRepository->getById($clientRequestId);

            $this->assertEquals($date, $clientRequest->delivery_date);
            $this->assertEquals(1, $response->getContent());
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

    /**
     * @param  User  $user
     * @return Leads
     */
    private function createLead(User $user, int $type):Leads
    {
        $lead = new Leads();
        $lead->type = $type;
        $lead->responsible_user_id = $user->id;
        $lead->save();

        return $lead;
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

}
