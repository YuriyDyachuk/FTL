<?php


namespace App\Http\Controllers\Tests\Orders;


use App\Http\Controllers\Tests\BaseController;
use Tests\Unit\Orders\TrainOrderTest;

class TrainController extends BaseController
{
    public function index()
    {
        $this->run(TrainOrderTest::class);
        $data = $this->getResultsList();

        return view('tests.index', ['data' => $data, 'pageName' => 'ЖД Заявка']);
    }
}
