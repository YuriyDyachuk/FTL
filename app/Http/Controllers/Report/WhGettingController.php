<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\Models\Entities\Report\WhGettingReport;
use App\Models\Repositories\Report\WhGettingRepository;
use Illuminate\Http\Request;

class WhGettingController extends Controller
{
    private $whGettingRepository;

    public function __construct(WhGettingRepository $whGettingRepository)
    {
        $this->whGettingRepository = $whGettingRepository;
    }

    public function getModalForm($id)
    {
        $model = $this->findModel($id);
        $canEdit = $model->canEdit();

        return view('report.whgetting.form', ['model' => $model, 'canEdit' => $canEdit])->render();
    }

    public function update(Request $request, $id)
    {
        $this->whGettingRepository->update($id, $request->toArray());

        return json_encode(['id' => $id]);
    }

    private function findModel($id)
    {
        return WhGettingReport::findOrFail($id);
    }
}
