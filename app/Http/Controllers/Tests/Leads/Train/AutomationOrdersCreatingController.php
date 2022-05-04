<?php


namespace App\Http\Controllers\Tests\Leads\Train;


use App\Http\Controllers\Tests\BaseController;
use Tests\Unit\Leads\Train\AutomationOrdersCreatingTest;

class AutomationOrdersCreatingController extends BaseController
{
    public function index()
    {
        $this->run(AutomationOrdersCreatingTest::class);
        $data = $this->getResultsList();

        return view('tests.index', ['data' => $data, 'pageName' => 'Автоматизация создания Заявок']);
    }
}
