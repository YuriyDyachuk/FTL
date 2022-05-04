<?php


namespace App\Http\Controllers\Tests;


use Tests\Unit\LoginPageTest as UnitLoginPageTest;
use Tests\Feature\LoginPage\LoginPageTest as FeatureLoginPageTest;

class LoginPageController extends BaseController
{
    public function index()
    {
        $this->run(FeatureLoginPageTest::class);
        $data = $this->getResultsList();

        return view('tests.index', ['data' => $data, 'pageName' => 'Страница Логина']);
    }
}
