<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function createId(Request $request)
    {
        $this->validate($request, [
            'pseudo' => 'required|string',
            'description' => 'required|string',
            'server' => 'required|url'
        ]);

        $p = new Person($request->all());
        $p->session_id = session()->getId();
        $p->public_key = str_random(30);
        $p->private_key = str_random(30);
        $p->server = $request->get('server');
        $p->save();

        return redirect('/');
    }

    public function listProfiles()
    {
        $profiles = Person::where('session_id', '=', session()->getId())->get();

        return view('idents', [
            'profiles' => $profiles->all()
        ]);
    }

    public function chat($id)
    {
        $person = Person::find($id);

        if(!$person instanceof Person){
            abort(404);
        }

        return view('chat', [
            'person' => $person
        ]);
    }

}