<?php

namespace App\Http\Controllers;

use App\Models\Entities\Client;
use App\Http\Requests\ClientRequest;
use App\Models\Entities\ClientImages;
use App\Models\Search\ClientsSearchModel;
use Illuminate\Http\Request;
use App\Models\Services\ClientService;
use Illuminate\Support\Arr;
use App\Models\Repositories\PhotoRepository;

class ClientController extends Controller
{
    private $clientService;
    private $photoRepository;

    public function __construct(ClientService $clientService, PhotoRepository $photoRepository)
    {
        $this->clientService = $clientService;
        $this->photoRepository = $photoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $searchModel = new ClientsSearchModel();
        $entities = $searchModel->search($request->query());
        return view('clients.index', ['entities' => $entities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $client = Client::create(['responsible_manager_id' => \Auth::getUser()->id]);
        return redirect()->route('clients.edit', ['client' => $client]);
        //return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $client = $this->clientService->create($request->toArray());
        return redirect()->route('clients.edit', ['client' => $client]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entities\Client  $client
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Client $client)
    {
        $images = $this->getImages($client);
        return view('clients.show', ['client' => $client, 'images' => $images]);
    }

    public function edit(Client $client)
    {
        if(!$this->canEdit($client)){
            return redirect()->route('clients.show', ['client' => $client]);
        }
        $images = $this->getImages($client);
        return view('clients.edit', ['client' => $client, 'images' => $images]);
    }

    public function addImage(Request $request)
    {
        $upload = $this->addImageToClient($request->toArray());

        return intval($upload);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entities\Client  $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $client = $this->clientService->update($request->toArray());
        return redirect()->route('clients.edit', ['client' => $client]);
    }

    public function validateAndSave(Request $request)
    {
        $this->clientService->update($request->toArray());
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entities\Client  $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Client $client)
    {
        $client->delete();
        $entities = Client::all();
        return redirect()->route('clients.index', ['entities' => $entities]);
    }

    private function addImageToClient(array $request)
    {
        $model = new ClientImages();
        $model->client_id = $request['client_id'];
        $model->file_name = $this->photoRepository->updateFile($request['img']);
        $model->name = $request['img']->getClientOriginalName();
        $model->type_id = $request['type_id'];
        return $model->save();
    }

    private function getImages(Client $client)
    {
        $result = [];
        $images = ClientImages::where('client_id', $client->id)->get();
        if(empty($images)){
            return [];
        }
        $images = array_values(Arr::sort($images, function ($value) {
            return $value['type_id'];
        }));
        foreach ($images as $element) {
            $result[$element['type_id']][] = $element;
        }
        return $result;
    }

    private function canEdit(Client $client)
    {
        $user = \Auth::getUser();
        if($user->hasRole('admin')){
            return true;
        }

        return $client->responsible_manager_id == $user->id;
    }

}
