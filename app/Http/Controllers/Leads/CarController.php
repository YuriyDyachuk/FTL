<?php


namespace App\Http\Controllers\Leads;


use App\Helpers\DateHelper;
use App\Http\Controllers\LeadsController;
use App\Models\Entities\GettingActCargo;
use App\Models\Entities\Leads;
use Auth;
use Illuminate\Http\Request;

class CarController extends LeadsController
{
    public function index(Request $request)
    {
        $filterData = [];
        if(empty($request->input('sort'))){
            $filterData = array_filter($request->toArray());
        }
        $leads = $this->leadsService->getLeadsForCurrentUser(Leads::CAR_TYPE, Auth::getUser(), $filterData);

        return view('leads.car.index', ['leads' => $leads]);
    }

    public function create()
    {
        $lead = $this->leadsService->createWithResponsibleUser(Leads::CAR_TYPE, Auth::id());

        return redirect()->route('leads.car.edit', ['lead' => $lead]);
    }

    public function edit(Leads $lead)
   {
       $period = DateHelper::getPeriod($lead->lead_date, $lead->deadline_date, 1);
       //$cargos = $this->leadsService->getProductsExcludeStatuses($lead, [GettingActCargo::IN_THE_CONTAINER_STATUS]);

       return view('leads.car.edit', ['lead' => $lead, 'period' => $period]);
  }

}
