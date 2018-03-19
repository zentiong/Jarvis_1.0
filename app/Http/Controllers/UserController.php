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
use App\Assessment;
use App\User_Assessment;
use App\Training;
use App\User_Training;

use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('HR', ['except' => 'show']);
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
            'birth_date' => 'required| before:now',
            'department' => 'required',
            'supervisor_id' => 'required',
            'position' => 'required',
            'password' => 'required| min:9'
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

            if($request->user_photo!=null) 
            {
                $photoName = time().'.'.$request->user_photo->getClientOriginalExtension();
                $user->profile_photo = $photoName;
                $request->user_photo->move(public_path('images/profile_photos/'), $photoName);
            }

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
        // Quiz

        $user = User::find($id);
        $user_quizzes = User_Quiz::where('user_id',$id)->get();
        $section_attempts = array();
        $sections = array();
        $skills_quiz = array();
        $skills_assessment = array();

        // ------------------

        // Statistics

        foreach($user_quizzes as $key => $user_quiz) {
            $section_attempts_temp = Section_Attempt::where('user_quiz_id',$user_quiz->id)->get(); 

            foreach($section_attempts_temp as $key => $temp) {
                array_push($section_attempts, $temp);
            }
        }

        foreach ($section_attempts as $key => $section_attempt) {
            array_push($sections,Section::where('id',$section_attempt->section_id)->first());
        }

        foreach ($sections as $key => $section) {
            $temp = Skill::where('id', $section->skill_id)->first(); //array
            if(!in_array($temp, $skills_quiz))
            {
                array_push($skills_quiz,$temp);
            }            
        }

        // Assessment

        $user_assessments = User_Assessment::where('employee_id', $id)->get();
        $assessments = array();

        foreach ($user_assessments as $key => $user_assessment) {

            $temp = Assessment::where('id',$user_assessment->assessment_id)->first(); 

            if(!in_array($temp, $assessments))
            {
                array_push($assessments,$temp);
            }         


        }

        foreach ($assessments as $key => $assessment) {

            $temp = Skill::where('id', $assessment->skill_id)->first(); //array

            if(!in_array($temp, $assessments))
            {
                array_push($skills_assessment,$temp);
            }         
        }

        // ------------------

        // Photo of Profile

        $profile_photo = 'images/profile_photos/'.$user->profile_photo;

        // Code for Photo of Current User

        $current_user_photo = 'images/profile_photos/'.Auth::user()->profile_photo;

       
        // ------------------

        // Trainings

        $trainings = array();
        $user_trainings = User_Training::where('user_id',$id)->get();

        foreach($user_trainings as $key => $user_training) {
            $training_temp = Training::where('id',$user_training->training_id)->first(); 
            array_push($trainings, $training_temp);
        }

        return View::make('users.show')
            ->with('user', $user)
            ->with('user_quizzes', $user_quizzes)
            ->with('section_attempts', $section_attempts)
            ->with('sections', $sections)
            ->with('skills_quiz', $skills_quiz)
            ->with('skills_assessment',$skills_assessment)
            ->with('user_assessments', $user_assessments)
            ->with('assessments', $assessments) 
            // ------
            ->with('profile_photo', $profile_photo)
            ->with('current_user_photo',$current_user_photo) 
            // ------
            ->with('trainings', $trainings)
            ->with('user_trainings', $user_trainings);
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
    public function update($id, Request $request)
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
            'password' => 'required | min:9'
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

            // ---------------- 
            

            // get current time and append the upload file extension to it,
            // then put that name to $photoName variable.
            if($request->user_photo!=null) 
            {
                $photoName = time().'.'.$request->user_photo->getClientOriginalExtension();
                $user->profile_photo = $photoName;
                $request->user_photo->move(public_path('images/profile_photos/'), $photoName);
            }
            

            // ---------------- 

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
