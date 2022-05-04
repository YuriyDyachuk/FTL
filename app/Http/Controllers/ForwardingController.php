<?php


namespace App\Http\Controllers;

use App\Models\Entities\Forwarding;
use Illuminate\Http\Request;
use App\Models\Services\ForwardingService;
use App\Models\Services\LeadsService;

class ForwardingController extends Controller
{
    private $forwardingService;
    private $leadsService;

    public function __construct(ForwardingService $forwardingService, LeadsService $leadsService)
    {
        $this->forwardingService = $forwardingService;
        $this->leadsService = $leadsService;
    }

    public function create(Request $request)
    {
        return $this->forwardingService->create($request->toArray());
    }

    public function addPhoto(Request $request)
    {
        $model = Forwarding::where('id', '=', $request->input('id'))->first();
        $photo = $request->file('photo');
        if($model && $photo){
            $model->photofix_path = $this->leadsService->updatePhoto($photo);
            $model->save();
            return redirect()->route('leads.edit', ['lead' => $request->input('leadId')]);
        }
    }
}
