<?php


namespace App\Http\Controllers\Tests\ClientRequest;


use App\Http\Controllers\Tests\BaseController;
use Tests\Unit\ClientRequest\ClientRequestTest;

class ClientRequestController extends BaseController
{
    public function index()
    {
        $this->run(ClientRequestTest::class);
        $data = $this->getResultsList();

        return view('tests.index', ['data' => $data, 'pageName' => 'Клиентская Заявка']);
    }
}
