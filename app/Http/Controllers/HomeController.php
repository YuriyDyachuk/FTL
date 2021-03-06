<?php

namespace App\Http\Controllers;

use App\Models\Entities\Goods;
use App\Title;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', ['title' => Title::get()]);
    }

}
