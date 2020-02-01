<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theory;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $theories = Theory::orderBy('created_at', 'desc')->get();

        return view('home', [
            'theories' => $theories
        ]);
    }
}
