<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Theory;
use App\Pokemon;
use Purifier;

class TheoryController extends Controller
{
    private $types;
    private $personalities;

    public function __construct() 
    {
        $this->middleware('auth')->except(['show']);
        $this->types = config('types');
        $this->personalities = config('personalities');
    }

    private function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|max:30',
            'pokemon_name' => 'required|max:6',
            'first_type' => 'required',
            'second_type' => 'nullable',
            'characteristic' => 'required',
            'personality' => 'required|max:5',
            'belongings' => 'required',
            'content' => 'required',
            'description' => 'nullable|max:30',
        ]);
    }

    private function exception_handling(string $id) {
        if (Auth::id() !== $id) {
            abort(401);
        }
    }

    public function show(Request $request, string $id) 
    {
        $theory = Theory::findOrFail($id);
        $get_content = $theory->content;
        
        // 有害なタグを除去(XSS対策)
        $content = Purifier::clean($get_content, array('Attr.EnableID' => true));

        return view('theory.show', [
            'theory' => $theory,
            'content' => $content
        ]);
    }

    public function create(Request $request) 
    {
        return view('theory.create', [
            'types' => $this->types,
            'personalities' => $this->personalities
        ]);
    }

    public function store(Request $request)
    {
        $theory = new Theory();
        $pokemon = new Pokemon();

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $theory->create([
            'title' => $request->title,
            'content' => $request->content,
            'description' => $request->description,
            'user_id' => $request->user()->id,
        ]);

        $pokemon->create([
            'pokemon_name' => $request->pokemon_name,
            'first_type' => $request->first_type,
            'second_type' => $request->second_type,
            'characteristic' => $request->characteristic,
            'personality' => $request->personality,
            'belongings' => $request->belongings,
            'user_id' => $request->user()->id,
            'theory_id' => $data->id,
        ]);

        return redirect('/');
    }

    public function edit(Request $request, string $id)
    {
        $theory = Theory::findOrFail($id);
        $this->exception_handling($theory->user_id);

        return view('theory.edit', [
            'theory' => $theory,
            'types' => $this->types,
            'personalities' => $this->personalities
        ]);
    }

    public function update(Request $request, string $id) 
    {
        $theory = Theory::findOrFail($id);
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $theory->fill($request->all())->save();
        $theory->pokemon->fill($request->all())->save();

        return redirect('/');
    }

    public function delete(string $id) 
    {
        $theory = Theory::findOrFail($id);
        $this->exception_handling($theory->user_id);

        $get_content = $theory->content;
        $content = Purifier::clean($get_content, array('Attr.EnableID' => true));

        return view ('theory.delete', [
            'theory' => $theory,
            'content' => $content
        ]);
    }

    public function destroy(string $id)
    {
        $theory = Theory::findOrFail($id);
        $theory->delete();
        return redirect('/');
    }
}
