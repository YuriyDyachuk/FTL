<?php


namespace App\Http\Controllers\ClientRequests;


use App\Http\Controllers\ClientRequestsController;
use App\Models\Entities\KtkTypeCatalog;
use App\Models\Entities\Leads;
use Auth;
use Illuminate\Http\Request;

class CarController extends ClientRequestsController
{
    public function index(Request $request)
    {
        $entities = $this->clientRequestService->getLeadsForCurrentUser(Leads::CAR_TYPE, Auth::getUser(), $request->input('q'));

        return view('clientrequests.car.index', ['entities' => $entities]);
    }

    public function validateAndSave(Request $request)
    {
        $validateMessageBag = $this->clientRequestValidationService->validate($request->all());
        if($validateMessageBag->count() === 0){
            $this->leadsService->handleClientRequestsForm($request->toArray());
            return 1;
        }else{
            return json_encode($validateMessageBag->getMessages());
        }
    }

    public function pickOrders(Request $request)
    {
        $excludedOrders = $this->leadsService->excludeCarOrders($request->input('type'));
        return view('clientrequests.car.pickOrders')->with('excludedOrders', $excludedOrders)->render();
    }

    public function createOrders(Request $request)
    {
        $jobStatusId = $this->leadsService->createCarOrders($request->toArray());

        return $jobStatusId;
    }

    public function getKtkTypeWeightData(Request $request)
    {
        return json_encode(KtkTypeCatalog::carTypesWeightVolume()[$request->input('type')]);
    }

}
