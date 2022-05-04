<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\Models\Entities\Report\HeavyRentReport;
use App\Models\Repositories\Report\HeavyRentRepository;
use Illuminate\Http\Request;

class HeavyRentController extends Controller
{
    private $heavyRentRepository;

    public function __construct(HeavyRentRepository $heavyRentRepository)
    {
        $this->heavyRentRepository = $heavyRentRepository;
    }

    public function getModalForm($id)
    {
        $model = $this->findModel($id);
        $canEdit = $model->canEdit();

        return view('report.heavyrent.form', ['model' => $model, 'canEdit' => $canEdit])->render();
    }

    public function update(Request $request, $id)
    {
        $this->heavyRentRepository->update($id, $request->toArray());

        return json_encode(['id' => $id]);
    }

    private function findModel($id)
    {
        return HeavyRentReport::findOrFail($id);
    }
}
