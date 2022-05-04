<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Repositories\Report\PowerOfAttorneyRepository;

class PowerOfAttorneyController extends Controller
{
    private $powerOfAttorneyRepository;

    public function __construct(PowerOfAttorneyRepository $powerOfAttorneyRepository)
    {
        $this->powerOfAttorneyRepository = $powerOfAttorneyRepository;
    }

    public function update($id, Request $request)
    {
        $model = $this->powerOfAttorneyRepository->findById($id);
        $this->powerOfAttorneyRepository->update($id, $request->toArray());

        return redirect()->route('order.edit', ['order' => $model->order]);
    }
}
