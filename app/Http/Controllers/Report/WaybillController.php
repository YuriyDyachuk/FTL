<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\Models\Entities\Report\WaybillReport;
use App\Models\Repositories\Report\WaybillRepository;
use Illuminate\Http\Request;

class WaybillController extends Controller
{
    private $waybillRepository;

    public function __construct(WaybillRepository $waybillRepository)
    {
        $this->waybillRepository = $waybillRepository;
    }

    public function getModalForm($id)
    {
        $model = $this->findModel($id);
        $canEdit = $model->canEdit();

        return view('report.waybill.form', ['model' => $model, 'canEdit' => $canEdit])->render();
    }

    public function update(Request $request, $id)
    {
        $this->waybillRepository->update($id, $request->toArray());

        return json_encode(['id' => $id]);
    }

    private function findModel($id)
    {
        return WaybillReport::findOrFail($id);
    }
}
