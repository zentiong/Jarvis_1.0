<?php

namespace App\Http\Controllers;

use App\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect; 
use View;

class TrainingSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $training_sessions = TrainingSession::all();

        // load the view and pass the employees
        return View::make('training_sessions.index')
            ->with('training_sessions', $training_sessions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('training_sessions.create');
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
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $training_session = new TrainingSession;
            $training_session->date = Input::get('date');
            $training_session->starting_time = Input::get('starting_time');
            $training_session->ending_time = Input::get('ending_time');
            $training_session->title = Input::get('title');
            $training_session->speaker = Input::get('speaker');
            $training_session->venue = Input::get('venue');
            $training_session->save();

            // redirect
            Session::flash('message', 'Successfully created Training Session!');
            return Redirect::to('training_sessions');
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
        $training_session = TrainingSession::find($id);

        return View::make('training_sessions.show')
            ->with('training_session', $training_session);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $training_session = TrainingSession::find($id);

        // show the edit form and pass the user
        return View::make('training_sessions.edit')
            ->with('training_session', $training_session);
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
            'speaker'      => 'required',
            'venue' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('training_sessions/'.$id.'/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $training_session = TrainingSession::find($id);
            $training_session->date = Input::get('date');
            $training_session->starting_time = Input::get('starting_time');
            $training_session->ending_time = Input::get('ending_time');
            $training_session->title = Input::get('title');
            $training_session->speaker = Input::get('speaker');
            $training_session->venue = Input::get('venue');
            $training_session->save();

            // redirect
            Session::flash('message', 'Successfully Updated Training Session!');
            return Redirect::to('training_sessions');
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
        $training_session = TrainingSession::find($id);
        $training_session->delete();

        // redirect
        Session::flash('message', 'Deleted Training Session!');
        return Redirect::to('training_sessions');
    }
}
