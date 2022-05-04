<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Models\Services\PhotoService;

class ProfileController extends Controller
{
    private $photoService;

    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    public function edit()
    {
        $user = \Auth::getUser();

        return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = \Auth::getUser();
        if($request->exists('photo')){
            $user->update(['photo' => $this->photoService->updateFile($request->file('photo'))]);
        }

        return redirect()->route('profile.edit');
    }
}
