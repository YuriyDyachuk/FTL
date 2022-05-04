<?php


namespace App\Http\Controllers\Report;


use App\Models\Entities\Report\CarPointReport;
use Illuminate\Http\Request;
use App\Models\Repositories\Report\CarPointRepository;

class CarPointController
{
    private $carPointRepository;

    public function __construct(CarPointRepository $carPointRepository)
    {
        $this->carPointRepository = $carPointRepository;
    }

    public function getModalForm($id)
    {
        $model = $this->findModel($id);
        $canEdit = $model->canEdit();

        return view('report.carpoint.form', ['model' => $model, 'canEdit' => $canEdit])->render();
    }

    public function update(Request $request, $id)
    {
        $this->carPointRepository->update($id, $request->toArray());

        return json_encode(['id' => $id]);
    }

    private function findModel($id)
    {
        return CarPointReport::findOrFail($id);
    }
}
