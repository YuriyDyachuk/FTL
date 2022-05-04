<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services\PhotoService;

class PhotoController extends Controller
{
    private $photoService;
    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    public function upload(Request $request)
    {
        $this->photoService->upload($request->toArray());
        return redirect()->back();
       // return redirect()->route('leads.edit', ['lead' => $request->input('leadId')]);
    }
}
