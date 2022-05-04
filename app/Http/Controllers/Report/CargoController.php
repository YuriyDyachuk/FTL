<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\Models\Entities\Report\CargoReport;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function getModalForm($id)
    {
        $model = $this->findModel($id);
        $canEdit = $model->canEdit();
        $warehouseCargos = $model->getWarehouseCargos();

        return view('report.cargo.form', ['warehouseCargos' => $warehouseCargos, 'canEdit' => $canEdit, 'model' => $model])->render();
    }

    public function update($id, Request $request)
    {
        $model = $this->findModel($id);
        $model->update($request->toArray());

        return json_encode(['id' => $id]);
    }

    private function findModel($id):CargoReport
    {
        return CargoReport::findOrFail($id);
    }
}
