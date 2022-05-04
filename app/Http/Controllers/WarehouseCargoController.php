<?php


namespace App\Http\Controllers;

use App\Models\Entities\EntityStatus;
use App\Models\Entities\Report\CargoReport;
use App\Models\Entities\WarehouseCargo;
use App\Models\Services\WarehouseCargoService;
use Illuminate\Http\Request;

class WarehouseCargoController extends Controller
{
    private $warehouseCargoService;

    public function __construct(WarehouseCargoService $warehouseCargoService)
    {
        $this->warehouseCargoService = $warehouseCargoService;
    }

    public function index()
    {
        $goods = $this->warehouseCargoService->getAll();

        return view('warehousecargo.index', ['goods' => $goods]);
    }

    public function getExportForm(Request $request)
    {
        $goodsIds = json_decode($request->input('ids'));
        $goods = $this->warehouseCargoService->getByIds($goodsIds);

        return view('warehousecargo.exportForm', ['goods' => $goods]);
    }

    public function exportCargo(Request $request)
    {
        $lead = $this->warehouseCargoService->exportGoods($request->input('lead_type'), $request->input('export'));

        return json_encode([
            'label' => $lead->getShortLabel(),
            'id' => $lead->id
        ]);
    }

    public function updateStatus(Request $request)
    {
        if($request->exists('id')){
            WarehouseCargo::whereIn('id', $request->input('id'))->update(['status' => $request->input('status')]);
            CargoReport::where('id', $request->input('cargo_id'))->update(['status' => EntityStatus::DONE_STATUS]);
        }

        return json_encode(['id' => $request->input('cargo_id')]);
    }
}
