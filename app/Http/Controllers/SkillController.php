<?php

namespace App\Http\Controllers;

use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;

 
class SkillController extends Controller
{
	public function __construct() 
	{
        $this->middleware('auth');
    }

    public function index()
    {
    	$skills = Skill::all();
        return View::make('skills.index')
            ->with('skills', $skills);
    }

    public function create()
    {
        return View::make('skills.create');
    }

    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'  => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('skills/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $skill = new Skill;
            $skill->name = Input::get('name');
            $skill->save();

            // redirect
            Session::flash('message', 'Added New Skill');
            return Redirect::to('skills');
        }
    }

	public function edit($id)
    {
        $skill = Skill::find($id);

        return View::make('skills.edit')
            ->with('skill', $skill);
    }

    public function update($id)
    {
         // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'  => 'required',            
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) 
        {
            return Redirect::to('skills/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } 
        else 
        {
            $skill = Skill::find($id);
            $skill->name = Input::get('name');
            $skill->save();
            Session::flash('message', 'Update Successful');
            return Redirect::to('skills');
        }
    }

    public function destroy($id)
    {
        $skill = Skill::find($id);
        $skill->delete();
        Session::flash('message', 'Removal Successful');
        return Redirect::to('skills');
    }


}