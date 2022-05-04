<?php

namespace App\Http\Controllers;


use App\Models\Entities\ClientRequestFrom;
use App\Models\Entities\ClientRequests;
use App\Models\Entities\EntityStatus;
use App\Models\Entities\KtkTypeCatalog;
use App\Models\Entities\Leads;
use App\Models\Entities\Order;
use App\Models\Services\ClientRequestService;
use App\Models\Services\LeadsService;
use App\Models\Services\WarehouseCargoService;
use Auth;
use Doctrine\DBAL\Schema\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Models\Validation\ClientRequestValidationService;
use Imtigger\LaravelJobStatus\JobStatus;

class ClientRequestsController extends Controller
{
    protected $leadsService;
    protected $clientRequestService;
    protected $clientRequestValidationService;
    protected $warehouseCargoService;

    public function __construct(LeadsService $leadsService,
                                ClientRequestService $clientRequestService,
                                ClientRequestValidationService $clientRequestValidationService,
                                WarehouseCargoService $warehouseCargoService)
    {
        $this->leadsService = $leadsService;
        $this->clientRequestService = $clientRequestService;
        $this->clientRequestValidationService = $clientRequestValidationService;
        $this->warehouseCargoService = $warehouseCargoService;
    }

    public function setStatus(Request $request)
    {
        $model = $this->clientRequestService->setStatus($request->input('id'), $request->input('status'));
        return redirect()->route('clientrequests.'.$model->lead->getShortLabel().'.edit', ['client' => $model]);
    }

    public function create(Leads $lead)
    {
        if(!$lead->clients()->exists()){
            return redirect()->route('leads.'.$lead->getShortLabel().'.edit', $lead)->with('error', 'Добавление КЗ без клиентов Сделки запрещено');
        }

        $clientRequest = $this->clientRequestService->updateByLeadIdOrCreate($lead->id, EntityStatus::NEW_STATUS, Auth::getUser()->id);

        return redirect()->route('clientrequests.'.$lead->getShortLabel().'.edit', ['client' => $clientRequest->id]);
    }

    public function edit(ClientRequests $client)
    {
        $clientIds = $client->lead->clients->pluck('id')->toArray();
        $goods = $this->warehouseCargoService->getByClientIds($clientIds);

        return view('clientrequests.'.$client->lead->getShortLabel().'.edit', ['lead' => $client->lead, 'client' => $client, 'goods' => $goods]);
    }

    public function getImportForm(Request $request)
    {
        $goodsIds = json_decode($request->input('ids'));
        $goods = $this->warehouseCargoService->getByIds($goodsIds);

        return view('clientrequests.importcargo.importForm', ['goods' => $goods]);
    }

    public function importCargo(Request $request)
    {
        $formGoods = '';
        parse_str($request->input('form'), $formGoods);
        $formGoods = $formGoods['import'];

        $clientRequest = $this->clientRequestService->getById($request->input('id'));

        $this->warehouseCargoService->importCargo($clientRequest->lead, $formGoods);
        $this->clientRequestService->removeEmptyProducts($clientRequest->lead);

        return 1;
    }

    public function destroy(Request $request)
    {
        $model = ClientRequests::where('id', '=', $request->input('id'))->first();
        $lead = Leads::where('id', '=', $model->lead_id)->first();
        if($model->delete()){
            return redirect()->route('leads.'.$lead->getShortLabel().'.edit', ['lead' => $lead]);
        }
    }

    public function getJobStatusProgress($jobStatusId)
    {
        $jobStatus = JobStatus::find($jobStatusId);

        return $jobStatus->progress_percentage;
    }

}
