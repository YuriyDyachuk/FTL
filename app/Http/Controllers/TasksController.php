<?php


namespace App\Http\Controllers;


use App\Models\Entities\Order;
use App\Models\Search\Tasks\CarTasksSearchModel;
use App\Models\Search\Tasks\TrTasksSearchModel;
use App\Models\Search\Tasks\WhTasksSearchModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function car(Request $request)
    {
//        $relations = ['clientBlock', 'ftlBlock', 'providerBlock', 'terminalBlock', 'trainBlock'];
//        //$relations = ['ftlBlock', 'clientBlock'];
//        $date = '08.04.2020';
//        $query = Order::query();
//        $orders = [];
//        foreach ($relations as $relation) {
//            $query->with($relation)->whereHas($relation.'.dateTimeBlock', function($q)use($date){
//                $q->where('date', $date);
//            });
//            if($query->where('type', Order::CAR_TYPE)->exists()){
//                $orders[] = $query->where('type', Order::CAR_TYPE)->get();
//            }
//
//        }
//
//
//        $query = $query->where('type', Order::CAR_TYPE);
//

        $searchModel = new CarTasksSearchModel();
        $entities = $searchModel->search($request->query());
      //  dd($entities, $query->toSql(), $query->get(), $orders);

        return view('tasks.car.index', ['entities' => $entities]);
    }

    public function wh(Request $request)
    {
        $searchModel = new WhTasksSearchModel();
        $entities = $searchModel->search($request->query());

        return view('tasks.wh.index', ['entities' => $entities]);
    }

    public function tr(Request $request)
    {
        $searchModel = new TrTasksSearchModel();
        $entities = $searchModel->search($request->query());


        return view('tasks.tr.index', ['entities' => $entities]);
    }
}
