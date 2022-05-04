<?php


namespace App\Http\Controllers\Leads;


use App\Http\Controllers\LeadsController;
use App\Models\Entities\Leads;
use Auth;
use Illuminate\Http\Request;

class WarehouseController extends LeadsController
{
    public function index(Request $request)
    {
        $filterData = [];
        if(empty($request->input('sort'))){
            $filterData = array_filter($request->toArray());
        }
        $leads = $this->leadsService->getLeadsForCurrentUser(Leads::WH_TYPE, Auth::getUser(), $filterData);

        return view('leads.car.index', ['leads' => $leads]);
    }

    public function create()
    {
        $lead = $this->leadsService->createWithResponsibleUser(Leads::WH_TYPE, Auth::id());

        return redirect()->route('leads.car.edit', ['lead' => $lead]);
    }
}
