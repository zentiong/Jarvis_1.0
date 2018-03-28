<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use App\Job_Grade;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect; 
use View;

class PositionController extends Controller
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
        $positions = Position::all()->sortBy('job_grade');
        $job_grades = Job_Grade::all();

        // load the view and pass the employees
        return View::make('positions.index')
            ->with('positions', $positions)
            ->with('job_grades', $job_grades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $job_grades = Job_Grade::all();
        return View::make('positions.create')
        ->with('job_grades', $job_grades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $rules = array(
            'name' => 'required',
            'job_grade' => 'required'    
            );
        
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('positions/create')
                ->withErrors($validator);
        } else {
            // store
            $position = new Position;
            $position->name = Input::get('name');
            $position->job_grade = Input::get('job_grade');
            $position->save();

            // redirect
            Session::flash('message', 'Successfully added new Position!');
            return Redirect::to('positions');
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
        $position = Position::find($id);
        $users = User::where('position', $position->name)->get();

        // show the view and pass the user to it
        return View::make('positions.show')
            ->with('users', $users)
            ->with('position', $position);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $position = Position::find($id);
         $job_grades = Job_Grade::all();

        return View::make('positions.edit')
            ->with('position', $position)
            ->with('job_grades', $job_grades);
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
            'name' => 'required',
            'job_grade' => 'required'
            
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('positions/create')
                ->withErrors($validator);
        } else {
            // store
            $position = Position::find($id);
            $position->name = Input::get('name');
            $position->job_grade = Input::get('job_grade');
            $position->save();

            // redirect
            Session::flash('message', 'Successfully Updated Position!');
            return Redirect::to('positions');
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
        $position = Position::find($id);
        $position->delete();

        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('positions');
    }

}
