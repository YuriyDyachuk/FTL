<?php

namespace App\Http\Controllers;

use App\Models\Entities\GettingAct;
use App\Models\Entities\GettingActDriverReport;
use App\Models\Entities\WarehouseCargo;
use App\Models\Services\{GettingActCargoService, GettingActService, WarehouseCargoService, CargoTypesService};
use Illuminate\Http\Request;
use App\Models\Repositories\ClientRepository;


class GettingActController extends Controller
{
    private $gettingActService;
    private $clientRepository;
    private $gettingActCargoService;
    private $warehouseCargoService;
    private $cargoTypesService;

    public function __construct(GettingActService $gettingActService,
        ClientRepository $clientRepository,
        GettingActCargoService $gettingActCargoService,
        WarehouseCargoService $warehouseCargoService,
        CargoTypesService $cargoTypesService)
    {
        $this->gettingActService = $gettingActService;
        $this->clientRepository = $clientRepository;
        $this->gettingActCargoService = $gettingActCargoService;
        $this->warehouseCargoService = $warehouseCargoService;
        $this->cargoTypesService = $cargoTypesService;
    }

    public function index()
    {
        $entities = $this->gettingActService->getAll();

        return view('gettingact.index', ['entities' => $entities]);
    }

    public function create()
    {
        $clients = $this->clientRepository->getAll();
        $report = new GettingActDriverReport();
        $cargoTypesList = $this->cargoTypesService->getList();

        return view('gettingact.create', ['clients' => $clients, 'report' => $report, 'cargoTypesList' => $cargoTypesList]);
    }

    public function store(Request $request)
    {
        $cargos = array_values($request->input('cargo'));
        $report = $request->input('report') ?: [];

        $model = $this->gettingActService->create($request->toArray());

        $this->saveCargo($model->id, $cargos);
        $this->saveReport($model, $report);

        $this->warehouseCargoService->importFromGettingAct($model, $cargos);

        return redirect()->route('gettingact.index');
    }

    public function edit($id)
    {
        $model = $this->gettingActService->getById($id);
        $clients = $this->clientRepository->getAll();
        $report = $model->driverReport()->exists() ? $model->driverReport : new GettingActDriverReport();
        $cargoTypesList = $this->cargoTypesService->getList();

        return view('gettingact.edit', ['model' => $model, 'clients' => $clients, 'report' => $report, 'cargoTypesList' => $cargoTypesList]);
    }

    public function update($id, Request $request)
    {
        $cargos = array_values($request->input('cargo'));
        $report = $request->input('report') ?: [];

        $model = $this->gettingActService->update($id, $request->toArray());
        $this->saveCargo($id, $cargos);
        $this->saveReport($model, $report);

        return redirect()->route('gettingact.index');
    }

    public function saveCargo(int $modelId, array $cargos)
    {
        if(!empty($cargos)){
            foreach ($cargos as $cargo) {
                $cargo['getting_act_id'] = $modelId;
                $this->gettingActCargoService->create($cargo);
            }
        }
    }

    private function saveReport(GettingAct $model, array $report)
    {
        if($model->driverReport()->exists()){
            $model->driverReport->update($report);
        }else{
            GettingActDriverReport::create(array_merge(['getting_act_id' => $model->id], $report));
        }
    }

    public function getCargoTypeFields(Request $request)
    {
        return $this->cargoTypesService->getFields(intval($request->input('id')));
    }

}
