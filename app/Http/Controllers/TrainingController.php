<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Training;
use App\User_Training;
use App\Quiz;
use App\User_Quiz;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect; 
use View;
use Auth;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //$this->middleware('auth', ['except' => ['landing']]);
        //$this->middleware('HR', ['except' => ['show', 'landing']]);
    }
    

    public function index()
    {
         $trainings = Training::all();

        // load the view and pass the employees
        return View::make('trainings.index')
            ->with('trainings', $trainings);
    }

    public function recommend()
    {
        $trainings = Training::all();


        // load the view and pass the employees
        return View::make('trainings.recommend')
            ->with('trainings', $trainings);
    }

    public function recommend_who()
    {
        $training_id = Input::get('training');

        $training = Training::find($training_id);
        $users = User::where('supervisor_id', Auth::user()->id)->get();

        $user_trainings = array();

         foreach ($users as $key => $user) {

            $temp = User_Training::where('user_id',$user->id)->get();

            foreach ($temp as $key => $t) {
                array_push($user_trainings, $t);
            }
         }

        // load the view and pass the employees
        return View::make('trainings.recommend_who')
            ->with('training', $training)
            ->with('users', $users)
            ->with('user_trainings', $user_trainings);
    }

    public function fire()
    {
        $users = User::where('supervisor_id', Auth::user()->id)->get();

        // foreach user

        foreach ($users as $key => $user) {

            if(Input::get($user->id)!=NULL)
            {
                $user_training = new User_Training;
                $user_training->training_id = Input::get('training');
                $user_training->user_id = Input::get($user->id);
                $user_training->recommended = true;
                $user_training->save();
            }
        }

        Session::flash('message', 'Successfully sent Recommendations!');
        return Redirect::to('recommend');
    }

    public function evaluate()
    {
        $training_id = Input::get('training_id');
        $user_training = User_Training::where('training_id',$training_id)->first();
        return View::make('trainings.evaluate')
        ->with('user_training', $user_training);
    }

    public function store_evaluation()
    {
        $training_id = Input::get('training_id');
        $user_training = User_Training::where('training_id',$training_id)
        ->where('user_id',Auth::user()->id)->first();
        $user_training->evaluation = Input::get('evaluation');

        $user_training->save();

        Session::flash('message', 'Successfully evaluated training session!');
        return Redirect::to('levels');
    }

    public function signup()
    {
        $user_training = new User_Training;
        $user_training->training_id = Input::get('training_id');
        $user_training->user_id = Input::get('user_id');
        $user_training->confirmed = true;
        $user_training->save();

        Session::flash('message', 'Successfully signed up!');
        return Redirect::to('levels');
    }

    public function confirm()
    {
        $user_id = Input::get('user_id');
        $training_id = Input::get('training_id');
        $user_training = User_training::where('user_id',$user_id)
        ->where('training_id', $training_id)->first();

        $user_training->confirmed = true;

        $user_training->save();


        Session::flash('message', 'Successfully Confirmed Slot!');
        return Redirect::to('levels');
    }

    // Commented out coz not sure if necessary -Ferny
    public function landing(){
        $trainings = Training::all();

        // load the view and pass the employees
        return View::make('welcome')
            ->with('trainings', $trainings);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $rules = array(
            'date'=> 'required',
            'starting_time'=> 'required',
            'ending_time'=> 'required',
            'title' => 'required',
            'speaker' => 'required',
            'venue' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/create')
                ->withErrors($validator);
        } else {
            // store
            $training = new Training;
            $training->date = Input::get('date');
            $training->starting_time = Input::get('starting_time');
            $training->ending_time = Input::get('ending_time');
            $training->title = Input::get('title');
            $training->speaker = Input::get('speaker');
            $training->venue = Input::get('venue');
            $training->save();

            // redirect
            Session::flash('message', 'Successfully created Training Session!');
            return Redirect::to('trainings');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $training = Training::find($id);
        $user_trainings = User_Training::where('training_id',$id)->get();
        $users = array();

        foreach ($user_trainings as $key => $user_training) {
            $user_id = $user_training->user_id;
            array_push($users, User::find($user_id));
        }

        $quiz = Quiz::where('training_id', $id)->first();
        $attendees = array();

        if($quiz!=null)
        {
        //$user_quizzes = array();
            $user_quizzes = User_Quiz::where('quiz_id',$quiz->quiz_id)->get();

            foreach ($user_quizzes as $key => $user_quiz) {
                $user_id = $user_quiz->user_id;
                array_push($attendees, User::find($user_id));
            }
        }

        return View::make('trainings.show')
            ->with('training', $training)
            ->with('user_trainings', $user_trainings)
            ->with('users',$users)
            ->with('attendees',$attendees);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $training = Training::find($id);

        // show the edit form and pass the user
        return View::make('trainings.edit')
            ->with('training', $training);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $rules = array(
            'date'=> 'required',
            'starting_time'=> 'required',
            'starting_time'=> 'required',
            'title' => 'required',
            'speaker'  => 'required',
            'venue' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('trainings/'.$id.'/create')
                ->withErrors($validator);
        } else {
            // store
            $training = Training::find($id);
            $training->date = Input::get('date');
            $training->starting_time = Input::get('starting_time');
            $training->ending_time = Input::get('ending_time');
            $training->title = Input::get('title');
            $training->speaker = Input::get('speaker');
            $training->venue = Input::get('venue');
            $training->save();

            // redirect
            Session::flash('message', 'Successfully Updated Training Session!');
            return Redirect::to('trainings');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $training = Training::find($id);
        $training->delete();

        // redirect
        Session::flash('message', 'Deleted Training Session!');
        return Redirect::to('trainings');
    }
}
