<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\Models\Entities\Report\TrainReport;
use Illuminate\Http\Request;
use App\Models\Repositories\Report\TrainRepository;

class TrainController extends Controller
{
    private $trainRepository;

    public function __construct(TrainRepository $trainRepository)
    {
        $this->trainRepository = $trainRepository;
    }

    public function getModalForm($id)
    {
        $model = $this->findModel($id);
        $canEdit = $model->canEdit();

        return view('report.train.form', ['model' => $model, 'canEdit' => $canEdit])->render();
    }

    public function update(Request $request, $id)
    {
        $this->trainRepository->update($id, $request->toArray());
        return json_encode(['id' => $id]);
    }

    private function findModel($id)
    {
        return TrainReport::findOrFail($id);
    }
}
