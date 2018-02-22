<?php

namespace App\Http\Controllers;

use App\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect; 
use View;

class TrainingController extends Controller
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
         $trainings = Training::all();

        // load the view and pass the employees
        return View::make('trainings.index')
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

        return View::make('trainings.show')
            ->with('training', $training);
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
