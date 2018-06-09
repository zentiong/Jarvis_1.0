<?php

namespace App\Http\Controllers;

use App\Policy;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect; 
use View;

class PolicyController extends Controller
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
        $policies = Policy::all();

        return View::make('policies.index')
            ->with('policies', $policies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('policies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $policy = new Policy;
        
        $policy->title = Input::get('title');
        $policy->description = Input::get('description');
        $policy->link = Input::get('link');

        if($request->policy_photo!=null) 
            {
                $photoName = time().'.'.$request->policy_photo->getClientOriginalExtension();
                $policy->logo = $photoName;
                $request->policy_photo->move(public_path('images/policy_photos/'), $photoName);
            }

        $policy->save();

        Session::flash('message', 'Successfully added a new Policy!');
        return Redirect::to('policies');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {   
        return View::make('policies.show')
            ->with('policy', $policy);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function edit(Policy $policy)
    {
        return View::make('policies.edit')
             ->with('policy', $policy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Policy $policy)
    {
        
        $policy->title = Input::get('title');
        $policy->description = Input::get('description');
        $policy->link = Input::get('link');

        if($request->policy_photo!=null) 
        {
            $photoName = time().'.'.$request->policy_photo->getClientOriginalExtension();
            $policy->logo = $photoName;
            $request->policy_photo->move(public_path('images/policy_photos/'), $photoName);
        }

        $policy->save();

            // redirect
        Session::flash('message', 'Successfully Updated Policy!');
        return Redirect::to('policies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policy $policy)
    {
        $policy->delete();

        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('policies');
    }
}
