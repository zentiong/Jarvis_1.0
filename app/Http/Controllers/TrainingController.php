<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Training;
use App\User_Training;
use App\Quiz;
use App\User_Quiz;
use App\Event;

use App\Service;
use App\Link;
use App\Policy;

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

        $this->middleware('auth', ['except' => ['landing', 'landing2']]);
        $this->middleware('HR', ['except' => ['show', 'landing', 'landing2', 'recommend', 'recommend_who', 'fire', 'signup', 'confirm', 'evaluate', 'store_evaluation']])
;    }


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

        if(Auth::user()->department == 'Human Resources')
        {
            $users = User::all();
        }
        else 
        {
            $users = User::where('supervisor_id', Auth::user()->id)->get();
        }
        


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
        if( Auth::user()->department == "Human Resources")
        {
            $users = User::all();
        }
        else
        {
            $users = User::where('supervisor_id', Auth::user()->id)->get();
        }
        
        if(Input::get('send_to_all')==true)
        {
            foreach ($users as $key => $user) {
                $check = User_Training::where('training_id', Input::get('training'))
                ->where('user_id',$user->id)->first();

                if($check == NULL)
                {
                    $user_training = new User_Training;
                    $user_training->training_id = Input::get('training');
                    $user_training->user_id = $user->id;
                    $user_training->recommended = true;
                    $user_training->save();
                }
            }
        }

        else
        {
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
        }

        Session::flash('message', 'Successfully sent Recommendations!');
        return Redirect::to('recommend');
    }

    public function evaluate()
    {
        $training_id = Input::get('training_id');
        $training = Training::find($training_id);
        $user_training = User_Training::where('training_id',$training_id)
        ->where('user_id',Auth::user()->id)->first();
        return View::make('trainings.evaluate')
        ->with('user_training', $user_training)
        ->with('training', $training);
    }

    public function store_evaluation()
    {
        $training_id = Input::get('training_id');
        $training_title = Training::find($training_id)->title;
        $user_training = User_Training::where('training_id',$training_id)
        ->where('user_id',Auth::user()->id)->first();

        $rules = array(
            'evaluation'       => 'required',
            'rating_training'       => 'required',
            'rating_speaker'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
             Session::flash('message', 'Please fill up all the fields.');
            return View::make('trainings.evaluate')
            ->with('user_training', $user_training)
            ->with('training_title', $training_title);
        } else {

        $user_training->evaluation = Input::get('evaluation');
        $user_training->rating_training = Input::get('rating_training');
        $user_training->rating_speaker = Input::get('rating_speaker');

        $user_training->save();

        }

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
        $events = Event::all();
            if (!isset($month)){
                $month = date('m');
            }
            
            if (!isset($year)){
                $year = date('Y');
            } 
            if ($month != 12){
                $nextMonth = $month + 1;
                $nextYear = $year;
            }
            else {
                $nextMonth = 1;
                $nextYear = $year + 1;
            }
            
            if ($month != 1){
                $prevMonth = $month -1;
                $prevYear = $year;
            }
            else{
                $prevMonth =  12;
                $prevYear = $year-1;
            }

            $nextMonth = $month+1;
            if($nextMonth < 10){
                $nM = $year.'-0'.$nextMonth.'-01';
            }
            else {
                $nM = $year.'-'.$nextMonth.'-01';
            }
            
        $monthName = date("F", mktime(null, null, null, $month));
        $thisMonth = $year.'-'.$month.'-01';

        $happenings = $events->where('date', ">=", $thisMonth)->where('date', '<', $nM);
        $temp = array();

        foreach ($happenings as $happening) {
            array_push($temp, $happening);
        }

        $happenings = $trainings->where('date', ">=", $thisMonth)->where('date', '<', $nM);
        foreach ($happenings as $happening) {
            array_push($temp, $happening);
        }

        $services = Service::all();
        $links = Link::all();
        $policies = Policy::all();

                // load the view and pass the employees
        return View::make('welcome')
            ->with('events', $events)
            ->with('month', $month)
            ->with('year', $year)
            ->with('temp', $temp)
            ->with('monthName', $monthName)
            ->with('thisMonth', $thisMonth)
            ->with('prevMonth', $prevMonth)
            ->with('nextMonth', $nextMonth)
            ->with('prevYear', $prevYear)
            ->with('nextYear', $nextYear)
            ->with('trainings', $trainings)
            ->with('services', $services)
            ->with('links', $links)
            ->with('policies',$policies);
    }

    public function landing2($month, $year){
        $trainings = Training::all();
        $events = Event::all();
        
        if ($month != 12){
            $nextMonth = $month + 1;
            $nextYear = $year;
        }
        else {
            $nextMonth = 1;
            $nextYear = $year + 1;
        }
        
        if ($month != 1){
            $prevMonth = $month -1;
            $prevYear = $year;
        }
        else{
            $prevMonth =  12;
            $prevYear = $year-1;
        }

        
        if($nextMonth < 10){
            $nM = $year.'-0'.$nextMonth.'-01';
        }
        else {
            $nM = $year.'-'.$nextMonth.'-01';
        }

        if($month < 10){
            $month = "0".$month;
        }
        $thisMonth = $year.'-'.$month.'-01';

        $monthName = date("F", mktime(null, null, null, $month));

        $happenings = $events->where('date', ">=", $thisMonth)->where('date', '<', $nM);
        $temp = array();

        foreach ($happenings as $happening) {
            array_push($temp, $happening);
        }

        $happenings = $trainings->where('date', ">=", $thisMonth)->where('date', '<', $nM);
        foreach ($happenings as $happening) {
            array_push($temp, $happening);
        }

        $services = Service::all();
        $links = Link::all();
        $policies = Policy::all();


        // load the view and pass the employees
        return View::make('welcome')
            ->with('events', $events)
            ->with('month', $month)
            ->with('year', $year)
            ->with('thisMonth', $thisMonth)
            ->with('monthName', $monthName)
            ->with('prevMonth', $prevMonth)
            ->with('nextMonth', $nextMonth)
            ->with('prevYear', $prevYear)
            ->with('nextYear', $nextYear)
            ->with('temp', $temp)
            ->with('trainings', $trainings)
            ->with('services', $services)
            ->with('links', $links)
            ->with('policies',$policies);
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
            'date'=> 'required|after_or_equal:today',
            'starting_time'=> 'required',
            'ending_time'=> 'required',
            'title' => 'required',
            'speaker' => 'required',
            'venue' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('trainings/create')
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
            'date'=> 'required|after_or_equal:today',
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
