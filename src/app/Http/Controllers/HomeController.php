<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theory;
use App\Pokemon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $types;
    private $personalities;

    public function __construct() 
    {
        $this->types = config('types');
        $this->personalities = config('personalities');
    }

    public function index(Request $request)
    {
        $query = Theory::query();
        $keyword = $request->keyword;

        if (!empty($keyword)) {
            $query->whereHas('pokemon', function($query) use($keyword) {
                $query->where('pokemon_name', 'like', '%'.$keyword.'%');
            });
        }

        $theories = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('home', [
            'theories' => $theories,
        ]);
    }

}
