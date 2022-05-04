<?php


namespace App\Http\Controllers\Report;


use App\Models\Entities\Report\CarReport;
use App\Models\Entities\Report\TrainReport;
use App\Models\Repositories\Report\CarRepository;
use Illuminate\Http\Request;

class CarController
{
    private $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function getModalForm($id)
    {
        $model = $this->findModel($id);
        $canEdit = $model->canEdit();

        return view('report.carreport.form', ['model' => $model, 'canEdit' => $canEdit])->render();
    }

    public function update(Request $request, $id)
    {
        $this->carRepository->update($id, $request->toArray());
        return json_encode(['id' => $id]);
    }

    private function findModel($id)
    {
        return CarReport::findOrFail($id);
    }
}
