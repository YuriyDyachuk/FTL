<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\Models\Entities\Report\RouteTrackReport;
use App\Models\Repositories\Report\RouteTrackRepository;
use Illuminate\Http\Request;

class RouteTrackController extends Controller
{
    private $routeTrackRepository;

    public function __construct(RouteTrackRepository $routeTrackRepository)
    {
        $this->routeTrackRepository = $routeTrackRepository;
    }

    public function getModalForm($id)
    {
        $model = $this->findModel($id);
        $canEdit = $model->canEdit();

        return view('report.routetrack.form', ['model' => $model, 'canEdit' => $canEdit])->render();
    }

    public function update(Request $request, $id)
    {
        $this->routeTrackRepository->update($id, $request->toArray());

        return json_encode(['id' => $id]);
    }

    private function findModel($id)
    {
        return RouteTrackReport::findOrFail($id);
    }
}
