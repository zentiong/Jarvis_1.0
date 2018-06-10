<?php

namespace App\Http\Controllers;

use App\Hr;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect; 
use View;

class HrController extends Controller
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
        //

        $hrs = Hr::all();

        return View::make('hrs.index')
            ->with('hrs', $hrs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('hrs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $hr = new Hr;
        
        $hr->name = Input::get('name');
        $hr->position = Input::get('position');

        if($request->hr_photo!=null) 
            {
                $photoName = time().'.'.$request->hr_photo->getClientOriginalExtension();
                $hr->photo = $photoName;
                $request->hr_photo->move(public_path('images/hr_photos/'), $photoName);
            }

        $hr->save();

        Session::flash('message', 'Successfully added a new HR!');
        return Redirect::to('hrs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hr  $hr
     * @return \Illuminate\Http\Response
     */
    public function show(Hr $hr)
    {
        //

        return View::make('hrs.show')
           ->with('hr', $hr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hr  $hr
     * @return \Illuminate\Http\Response
     */
    public function edit(Hr $hr)
    {
        //
        return View::make('hrs.edit')
             ->with('hr', $hr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hr  $hr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hr $hr)
    {
        //

        $hr->name = Input::get('name');
        $hr->position = Input::get('position');

        if($request->hr_photo!=null) 
        {
            $photoName = time().'.'.$request->hr_photo->getClientOriginalExtension();
            $hr->photo = $photoName;
            $request->hr_photo->move(public_path('images/hr_photos/'), $photoName);
        }

        $hr->save();

            // redirect
        Session::flash('message', 'Successfully Updated HR!');
        return Redirect::to('hrs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hr  $hr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hr $hr)
    {
        //
        $hr->delete();

        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('hrs');
    }
}
