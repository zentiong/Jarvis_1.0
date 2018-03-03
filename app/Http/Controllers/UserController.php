<?php

namespace App\Http\Controllers;

use App\User;
use App\Position;
use App\User_Quiz;
use App\Attempt;
use App\Question;
use App\Section;
use App\Skill;
use App\Section_Attempt;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        // get all the users
        $users = User::all();
        $positions = Position::all();

        // load the view and pass the users
        return View::make('users.index')
            ->with('users', $users)
            ->with('positions',$positions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('manager_check',1)->get();
        $positions = Position::all();

        return View::make('users.create')
        ->with('users',$users)
        ->with('positions',$positions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'first_name'       => 'required',
            'last_name' => 'required',
            'email'      => 'required|email',
            'hiring_date' => 'required',
            'birth_date' => 'required',
            'department' => 'required',
            'supervisor_id' => 'required',
            'position' => 'required',
            'password' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user = new User;
            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->email = Input::get('email');
            $user->password = bcrypt(Input::get('password'));
            $user->hiring_date = Input::get('hiring_date');
            $user->birth_date = Input::get('birth_date');
            $user->department = Input::get('department');
            $user->supervisor_id = Input::get('supervisor_id');
            $user->position = Input::get('position');

            // Default Value in migrations ain't working

            if(Input::get('manager_check')!=NULL)
            {
                $user->manager_check = Input::get('manager_check');
            }

            else 
            {
                $user->manager_check = false;
            }

            $user->save();

            // redirect
            Session::flash('message', 'Successfully created user!');
            return Redirect::to('users');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the user
        $user = User::find($id);
        $user_quizzes = User_Quiz::where('user_id',$id)->get();
        $section_attempts = array();
        $sections = array();
        $skills = array();

        foreach($user_quizzes as $key => $user_quiz) {
            $section_attempts_temp = Section_Attempt::where('user_quiz_id',$user_quiz->id)->get(); 

            foreach($section_attempts_temp as $key => $temp) {
                array_push($section_attempts, $temp);
            }
        }

        foreach ($section_attempts as $key => $section_attempt) {
            $section_temp = Section::where('id',$section_attempt->section_id)->get();
            foreach($section_temp as $key => $temp) {
                array_push($sections,$temp);
            }
        }

        foreach ($sections as $key => $section) {
            $temp = Skill::where('id', $section->skill_id)->first(); //array
            if(!in_array($temp, $skills))
            {
                array_push($skills,$temp);
            }            
        }

        return View::make('users.show')
            ->with('user', $user)
            ->with('user_quizzes', $user_quizzes)
            ->with('section_attempts', $section_attempts)
            ->with('sections', $sections)
            ->with('skills',$skills);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
                 // get the user
        $user = User::find($id);
        $users = User::where('manager_check',1)->get();


        // show the edit form and pass the user
        return View::make('users.edit')
            ->with('user', $user)
            ->with('users',$users);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'first_name'       => 'required',
            'last_name' => 'required',
            'email'      => 'required|email',
            'hiring_date' => 'required',
            'birth_date' => 'required',
            'department' => 'required',
            'supervisor_id' => 'required',
            'position' => 'required',
            'password' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user = User::find($id);
            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->email = Input::get('email');
            $user->password = bcrypt(Input::get('password'));
            $user->hiring_date = Input::get('hiring_date');
            $user->birth_date = Input::get('birth_date');
            $user->department = Input::get('department');
            $user->supervisor_id = Input::get('supervisor_id');
            $user->position = Input::get('position');
            if(Input::get('manager_check')!=NULL)
            {
                $user->manager_check = Input::get('manager_check');
            }

            else 
            {
                $user->manager_check = false;
            }
            $user->save();

            // redirect
            Session::flash('message', 'Successfully updated user!');
            return Redirect::to('users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $user = User::find($id);
        $user->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the user!');
        return Redirect::to('users');
    }
}
