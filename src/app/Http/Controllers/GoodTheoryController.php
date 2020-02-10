<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\GoodTheory;

class GoodTheoryController extends Controller
{
    public function store(Request $request, string $theory_id)
    {
        $good_theory = new GoodTheory();
        $auth_id = Auth::id();

        $good_theory->create([
           'theory_id' => $theory_id,
           'user_id' => $auth_id,
        ]);

        $good_count = GoodTheory::where('theory_id', $theory_id)->count();

        return response()->json(['good_count' => $good_count]);
    }

    public function destroy(Request $request, string $theory_id)
    {
        $auth_id = Auth::id();
        $good_theory = GoodTheory::where('theory_id', $theory_id)->where('user_id', $auth_id);
        $user_id = $good_theory->first()->user_id;

        if($good_theory->exists() && $auth_id === $user_id) {
            $good_theory->delete();
        }

        $good_count = GoodTheory::where('theory_id', $theory_id)->count();

        return response()->json(['good_count' => $good_count]);
    }
}
