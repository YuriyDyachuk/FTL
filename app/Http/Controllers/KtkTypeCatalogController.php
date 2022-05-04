<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsAdmin;
use App\Models\Entities\KtkTypeCatalog;
use App\Http\Requests\KtkTypeCatalogRequest;
use App\Models\Services\KtkTypeCatalogService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KtkTypeCatalogController extends Controller
{
    private $ktkTypeCatalogService;

    public function __construct(KtkTypeCatalogService $ktkTypeCatalogService)
    {
        $this->ktkTypeCatalogService = $ktkTypeCatalogService;
        $this->middleware(IsAdmin::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = KtkTypeCatalog::paginate(10);
        return view('ktktypecatalog.index', ['types' => $types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ktktypecatalog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\KtkTypeCatalogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KtkTypeCatalogRequest $request)
    {
        $type = KtkTypeCatalog::create($request->validated());
        return redirect()->route('ktktypecatalog.show', ['type' => $type]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\KtkTypeCatalog $type
     * @return \Illuminate\Http\Response
     */
    public function show(KtkTypeCatalog $type)
    {
        return view('ktktypecatalog.show', ['type' => $type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\KtkTypeCatalog  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(KtkTypeCatalog $type)
    {
        return view('ktktypecatalog.edit', ['type' => $type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\KtkTypeCatalogRequest $request
     * @param  \App\Entities\KtkTypeCatalog  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KtkTypeCatalog $type)
    {
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('ktk_type_catalog')->ignore($type->id)
            ]
        ]);
        $type->update($request->all());
        return redirect()->route('ktktypecatalog.show', ['lead' => $type]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\KtkTypeCatalog  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(KtkTypeCatalog $type)
    {
        $type->delete();
        return redirect()->route('ktktypecatalog.index');
    }

    public function sort(Request $request)
    {
        $types = $this->ktkTypeCatalogService->filter($request);
        return view('ktktypecatalog.index', ['types' => $types->paginate(10)]);
    }
}
