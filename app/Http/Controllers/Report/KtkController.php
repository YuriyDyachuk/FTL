<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\Models\Entities\GettingActCargo;
use App\Models\Entities\Leads;
use Illuminate\Http\Request;
use App\Models\Services\LeadsService;

class KtkController extends Controller
{
    private LeadsService $leadsService;

    public function __construct(LeadsService $leadsService)
    {
        $this->leadsService = $leadsService;
    }

    public function getModalForm(Leads $lead)
    {
        $cargos = $this->leadsService->getProductsExcludeStatuses($lead, [GettingActCargo::IN_THE_CONTAINER_STATUS]);

        return view('report.ktkdownl.cargos', ['cargos' => $cargos, 'lead' => $lead]);
    }
}
