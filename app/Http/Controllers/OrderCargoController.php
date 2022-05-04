<?php


namespace App\Http\Controllers;


use App\Models\Entities\OrderCargo;
use Illuminate\Http\Request;

class OrderCargoController extends Controller
{
    public function create(Request $request)
    {
        //dd($request->toArray());
        $model = OrderCargo::create($request->toArray());
    }
}
