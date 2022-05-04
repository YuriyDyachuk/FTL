<?php


namespace App\Http\Controllers;


use App\Models\Entities\ClientRequestProducts;
use App\Models\Services\GettingActCargoService;
use Illuminate\Http\Request;
use App\Models\Services\ClientRequestProductsService;

class GettingActCargoController extends Controller
{
    private $gettingActCargoService;

    public function __construct(GettingActCargoService $gettingActCargoService)
    {
        $this->gettingActCargoService = $gettingActCargoService;
    }

    public function index(Request $request)
    {
        $cargos = $this->gettingActCargoService->getAll();

        return view('gettingactcargo.index', ['cargos' => $cargos]);
    }

    public function create()
    {
        return view('gettingactcargo.create');
    }

    public function store(Request $request)
    {
        $this->gettingActCargoService->create($request->toArray());

        return redirect()->route('gettingactcargo.index');
    }

    public function edit($id)
    {
        $model = $this->gettingActCargoService->getById($id);

        return view('gettingactcargo.edit', ['model' => $model]);
    }

    public function update($id, Request $request)
    {
        $this->gettingActCargoService->update($id, $request->toArray());

        return redirect()->route('gettingactcargo.index');
    }
}
