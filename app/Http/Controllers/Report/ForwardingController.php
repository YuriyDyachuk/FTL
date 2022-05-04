<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use App\Models\Entities\Report\ForwardingReport;
use App\Models\Repositories\Report\ForwardingRepository;
use Illuminate\Http\Request;

class ForwardingController extends Controller
{
    private $forwardingRepository;

    public function __construct(ForwardingRepository $forwardingRepository)
    {
        $this->forwardingRepository = $forwardingRepository;
    }

    public function getModalForm($id)
    {
        $model = $this->findModel($id);
        $canEdit = $model->canEdit();

        return view('report.forwarding.form', ['model' => $model, 'canEdit' => $canEdit])->render();
    }

    public function update(Request $request, $id)
    {
        $this->forwardingRepository->update($id, $request->toArray());

        return json_encode(['id' => $id]);
    }

    private function findModel($id)
    {
        return ForwardingReport::findOrFail($id);
    }
}
