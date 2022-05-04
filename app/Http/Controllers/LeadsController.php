<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Models\Entities\GettingActCargo;
use App\Models\Entities\Leads;
use App\Models\Services\LeadsService;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Repositories\ClientRepository;

class LeadsController extends Controller
{
    protected $leadsService;
    protected $clientRepository;

    public function __construct(LeadsService $leadsService,
                                ClientRepository $clientRepository)
    {
        $this->leadsService = $leadsService;
        $this->clientRepository = $clientRepository;
      //  $this->middleware(LeadsOwner::class, ['only' => 'index']);
      //  $this->middleware(LeadView::class, ['only' => 'edit', 'show']);
    }

    public function indexTr(Request $request)
    {
        $filterData = [];
        if(empty($request->input('sort'))){
            $filterData = array_filter($request->toArray());
        }
        $leads = $this->leadsService->getLeadsForCurrentUser(Leads::TR_TYPE, Auth::getUser(), $filterData);

        return view('leads.tr.index', ['leads' => $leads]);
    }

    public function index(Request $request)
    {

    }

    public function update(Request $request, Leads $lead)
    {
        $this->leadsService->handleLeadForm($request->toArray());
        return redirect()->route('leads.edit', ['lead' => $lead]);
    }

    public function destroy(Leads $lead)
    {
        try {
            $lead->delete();
        } catch (\Exception $e) {
            return redirect()->route('leads.'.$lead->getShortLabel().'.index')->with('error', $e->getMessage());
        }
        return redirect()->route('leads.'.$lead->getShortLabel().'.index');
    }

    public function sort(Request $request)
    {
        $leads = $this->leadsService->filter($request);
        //dd($leads->get());
        $clientsList = $this->clientRepository->getClientsList();
        return view('leads.index', ['leads' => $leads->sortable()->paginate(env('ITEMS_PER_PAGE')), 'clientsList' => $clientsList]);
    }

    public function validateAndSave(Request $request)
    {
        $validateMessages = $this->leadsService->validateForm($request->all());
        if($validateMessages->count() === 0){
            $this->leadsService->handleLeadForm($request->toArray());
            return 1;
        }else{
            return json_encode($validateMessages);
        }
    }

}
