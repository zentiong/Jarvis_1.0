<?php

namespace App\Http\Controllers;

use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;
use Auth;
use App\User;

 
class SkillController extends Controller
{
	public function __construct() 
	{
        $this->middleware('auth');
        
        
       
    }

    public function authenticate()
    {
        if (Auth::user()->department != 'Human Resources') {
            return redirect('/');
        }
    }

    public function index()
    {
        
        
    	$skills = Skill::all()->sortBy('name');
        return View::make('skills.index')
            ->with('skills', $skills);
    }

    public function create()
    {
        if (Auth::user()->department != 'Human Resources') {
            return redirect('/');
        }

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
            $skill->description = Input::get('description');
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
            $skill->description = Input::get('description');
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