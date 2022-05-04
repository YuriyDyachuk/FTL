<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsAdmin;
use App\Models\Entities\PackingSizeCatalog;
use App\Http\Requests\PackingSizeCatalogRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Services\PackingSizeCatalogService;

class PackingSizeCatalogController extends Controller
{
    private $packingSizeCatalogService;

    public function __construct(PackingSizeCatalogService $packingSizeCatalogService)
    {
        $this->packingSizeCatalogService = $packingSizeCatalogService;
        $this->middleware(IsAdmin::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = PackingSizeCatalog::all();
        return view('packingsizecatalog.index', ['sizes' => $sizes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('packingsizecatalog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PackingSizeCatalogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackingSizeCatalogRequest $request)
    {
        $size = PackingSizeCatalog::create($request->validated());
        return redirect()->route('packingsizecatalog.show', ['size' => $size]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entities\PackingSizeCatalog  $size
     * @return \Illuminate\Http\Response
     */
    public function show(PackingSizeCatalog $size)
    {
        return view('packingsizecatalog.show', ['size' => $size]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entities\PackingSizeCatalog  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(PackingSizeCatalog $size)
    {
        return view('packingsizecatalog.edit', ['size' => $size]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entities\PackingSizeCatalog  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackingSizeCatalog $size)
    {
        $this->validate($request, [
            'size' => [
                'required',
                Rule::unique('packing_size_catalog')->ignore($size->id)
            ]
        ]);
        $size->update($request->all());
        return redirect()->route('packingsizecatalog.show', ['size' => $size]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entities\PackingSizeCatalog  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackingSizeCatalog $size)
    {
        $size->delete();
        return redirect()->route('packingsizecatalog.index');
    }

    public function sort(Request $request)
    {
        $sizes = $this->packingSizeCatalogService->filter($request);
        return view('packingsizecatalog.index', ['sizes' => $sizes->get()]);
    }
}
