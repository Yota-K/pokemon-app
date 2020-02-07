<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\User;
use App\Theory;

class UserController extends Controller
{
    public function show(Request $request, string $id) 
    {
        $user = User::findOrFail($id);
        $user_id = $user->id;
        $theories = Theory::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(5);

        return view('user.show', [
            'user' => $user,
            'theories' => $theories
        ]);
    }

    public function edit(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        return view ('user.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'introduction' => 'string|max:150',
            'icon' => 'file|image|mimes:jpeng,jpg,png,gif',
        ]);

        if ($request->hasFile('icon')) {
            $get_file_name = $request->file('icon')->getClientOriginalName();
            $pathname = "users/{$id}/icon/{$get_file_name}";
            $request->file('icon')->storeAs('public', $pathname);
            $user->icon_url = $pathname;
        }
        else {
            $user->icon_url = null;
        }

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $user->fill($request->all())->save();

        return redirect("/user/{$id}");
    }
}
