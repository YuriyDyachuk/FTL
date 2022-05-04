<?php


namespace App\Http\Controllers\Tests;

use App\Models\Services\TestsService;

class AllTestsController extends BaseController
{
    private TestsService $testsService;

    public function __construct(TestsService $testsService)
    {
        $this->testsService = $testsService;
        parent::__construct();
    }


    public function index()
    {
        $tests = [];
        foreach ($this->testsService->getAllTests() as $allTest) {
            $this->run($allTest['class']);
            $tests[$allTest['title']] = $this->getResultsList();
        }

        return view('tests.all.index', ['tests' => $tests]);
    }
}
