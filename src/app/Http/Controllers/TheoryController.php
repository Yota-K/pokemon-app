<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Theory;
use App\Pokemon;
use App\Skill;
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
            'skill_name_1' => 'required|max:10',
            'skill_name_2' => 'required|max:10',
            'skill_name_3' => 'required|max:10',
            'skill_name_4' => 'required|max:10',
            'characteristic' => 'required',
            'personality' => 'required|max:5',
            'belongings' => 'required',
            'content' => 'required',
            'description' => 'nullable|max:30',
        ]);
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
        $skill = new Skill();

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $theory_data = $theory->create([
            'title' => $request->title,
            'content' => $request->content,
            'description' => $request->description,
            'user_id' => $request->user()->id,
        ]);

        $pokemon_data = $pokemon->create([
            'pokemon_name' => $request->pokemon_name,
            'first_type' => $request->first_type,
            'second_type' => $request->second_type,
            'characteristic' => $request->characteristic,
            'personality' => $request->personality,
            'belongings' => $request->belongings,
            'user_id' => $request->user()->id,
            'theory_id' => $theory_data->id,
        ]);

        $skill->create([
            'skill_name_1' => $request->skill_name_1,
            'skill_name_2' => $request->skill_name_2,
            'skill_name_3' => $request->skill_name_3,
            'skill_name_4' => $request->skill_name_4,
            'pokemon_id' => $pokemon_data->id,
            'theory_id' => $theory_data->id,
        ]);

        return redirect('/');
    }

    public function edit(Request $request, string $id)
    {
        $theory = Theory::findOrFail($id);

        if (Auth::id() !== $theory->user_id) {
            abort(401);
        }

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
        $theory->skill->fill($request->all())->save();

        return redirect('/');
    }

    public function delete(string $id) 
    {
        $theory = Theory::findOrFail($id);

        if (Auth::id() !== $theory->user_id) {
            abort(401);
        }

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
