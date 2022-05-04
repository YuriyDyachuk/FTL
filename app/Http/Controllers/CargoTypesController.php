<?php

namespace App\Http\Controllers;

use App\Models\Entities\CargoTypes;
use App\Models\Repositories\ClientRepository;
use Illuminate\Http\Request;

class CargoTypesController extends Controller
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function index()
    {
        $entities = CargoTypes::sortable()->paginate(env('ITEMS_PER_PAGE'));

        return view('cargoTypes.index', ['entities' => $entities]);
    }

    public function create()
    {
        $model = new CargoTypes();

        $clients = $this->clientRepository->getAll();

        return view('cargoTypes.create', ['model' => $model, 'clients' => $clients]);
    }

    public function store(Request $request)
    {
        CargoTypes::create($request->toArray());

        return redirect()->route('cargotypes.index');
    }

    public function edit(int $id)
    {
        $model = $this->findModel($id);
        $clients = $this->clientRepository->getAll();

        return view('cargoTypes.edit', ['model' => $model, 'clients' => $clients]);
    }

    public function update(int $id, Request $request)
    {
        $model = $this->findModel($id);
        $model->update($request->toArray());

        return redirect()->route('cargotypes.index');
    }

    public function destroy(int $id)
    {
        $model = $this->findModel($id);
        try {
            $model->delete();
            return redirect()->route('cargotypes.index');
        } catch (\Exception $e) {
            return redirect()->route('cargotypes.index')->withErrors($e->getMessage());
        }
    }

    private function findModel($id)
    {
        return CargoTypes::findOrFail($id);
    }

    public function autocompleteList(Request $request)
    {
        $query = $request->input('query');
        $client = $request->input('client');
        $provider = $request->input('provider');



        $res = [];
        $sql = CargoTypes::where('name', 'like', '%'.$query.'%');
        if(!empty($client)){
            if(intval($client) === 0){
                $client = $this->clientRepository->findByName($client)->id;
            }
            $sql->where('client_id', $client);
        }
        if(!empty($provider)){
            $sql->where('provider_name', $provider);
        }
        $entities = $sql->get();
        if(!empty($entities)){
            foreach ($entities as $entity) {
                $res[] = [
                    'value' => $entity->name,
                    'data' => $entity->id,
                    'client_id' => $entity->client_id,
                    'provider_name' => $entity->provider_name
                ];
            }
        }

        return json_encode($res);
    }
}
