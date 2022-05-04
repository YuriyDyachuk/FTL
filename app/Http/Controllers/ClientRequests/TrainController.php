<?php


namespace App\Http\Controllers\ClientRequests;


use App\Http\Controllers\ClientRequestsController;
use App\Models\Entities\ClientRequests;
use App\Models\Entities\EntityStatus;
use App\Models\Entities\KtkTypeCatalog;
use App\Models\Entities\Leads;
use Auth;
use Illuminate\Http\Request;

class TrainController extends ClientRequestsController
{
    public function index(Request $request)
    {
        $entities = $this->clientRequestService->getLeadsForCurrentUser(Leads::TR_TYPE, Auth::getUser(), $request->input('q'));

        return view('clientrequests.tr.index', ['entities' => $entities]);
    }

    public function validateAndSave(Request $request)
    {
        $validateMessageBag = $this->clientRequestValidationService->validate($request->all());
        if($validateMessageBag->count() === 0){
            $this->leadsService->handleClientRequestsForm($request->toArray());
            return 1;
        }else{
            $messages = $this->clientRequestValidationService->getUniqueMessages($validateMessageBag->getMessages());
            return json_encode($messages);
        }
    }

    public function pickOrders(Request $request)
    {
        $excludedOrders = $this->leadsService->excludeTrainOrders($request->input('type'));

        return view('clientrequests.tr.pickOrders')->with('excludedOrders', $excludedOrders)->render();
    }

    public function createOrders(Request $request)
    {
        $jobStatusId = $this->leadsService->createTrOrders($request->toArray());

        return $jobStatusId;
    }

    public function getKtkTypeWeightData(Request $request)
    {
        return json_encode(KtkTypeCatalog::ktkTypesWeightVolume()[$request->input('type')]);
    }

}
