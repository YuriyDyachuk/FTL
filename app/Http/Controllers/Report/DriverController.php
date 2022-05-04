<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\Models\Entities\Report\CargoReport;
use App\Models\Entities\Report\DriverReport;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function getModalForm($id)
    {
        $model = $this->findModel($id);
        $canEdit = $model->canEdit();
        $driverBlock = $model->order->driverBlock;

        return view('report.driver.form', ['model' => $model, 'canEdit' => $canEdit, 'driverBlock' => $driverBlock])->render();
    }

    public function update($id, Request $request)
    {
        $model = $this->findModel($id);
        $model->update($request->toArray());

        return json_encode(['id' => $id]);
    }

    private function findModel($id)
    {
        return DriverReport::findOrFail($id);
    }
}
