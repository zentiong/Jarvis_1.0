<?php

namespace App\Http\Controllers;


use App\Assessment;
use App\Assessment_Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;

class Assessment_ItemController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct() {
        $this->middleware('auth');
    }

    public function index($id)
    {
        
  // get all the assessments
        $assessment = Assessment::find($id);

        //working SQL
        //$assessment_items = Assessment_Item::where('id', $id)->get();
        
        // working ELOQUENT
        $assessment_items = $assessment->assessment_items()->get();

          // show the view and pass the assessment to it
        return View::make('assessment_items.index')
            ->with('assessment', $assessment)
            ->with('assessment_items', $assessment_items);
    }

    

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return View::make('assessment_items.create')
        ->with('id', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'criteria'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('assessments/'.$id.'/assessment_items/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $assessment_item = new Assessment_Item;
            $assessment_item->criteria = Input::get('criteria');
            $assessment_item->assessment_id = $id;
            $assessment_item->save();

            // redirect
            Session::flash('message', 'Successfully created assessment_item!');
            return Redirect::to('assessments');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assessment_Item  $assessment_item
     * @return \Illuminate\Http\Response
     */
    public function show($assessment_id, $id)
    {
        //
        $assessment = Assessment::find($assessment_id);
        $assessment_item = Assessment_Item::find($id);

         return View::make('assessment_items.show')
            ->with('assessment', $assessment)
            ->with('assessment_item', $assessment_item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assessment_Item  $assessment_item
     * @return \Illuminate\Http\Response
     */
    public function edit($assessment_id, $id)
    {
        
          // get the assessment
        $assessment = Assessment::find($assessment_id);
        $assessment_item = Assessment_Item::find($id);

        // show the edit form and pass the assessment_item
        return View::make('assessment_items.edit')
            ->with('assessment_item', $assessment_item)
            ->with('assessment', $assessment);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assessment_Item  $assessment_item
     * @return \Illuminate\Http\Response
     */
    public function update($assessment_id, $id)
    {
        $rules = array(
            'criteria'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('assessments/'.$assessment_id.'/assessment_items/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $assessment_item = Assessment_Item::find($id);
            $assessment_item->criteria= Input::get('criteria');
            $assessment_item->save();

            // redirect
            Session::flash('message', 'Successfully edited assessment_item!');
            return Redirect::to('assessments/'.$assessment_id.'/assessment_items');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assessment_Item  $assessment_item
     * @return \Illuminate\Http\Response
     */
    public function destroy($assessment_id, $id)
    {

        // delete (working)
        $assessment_item = Assessment_Item::find($id);
        $assessment_item->delete();

        // redirect (working)
        Session::flash('message', 'Successfully deleted the assessment_item!');
        return Redirect::to('assessments/'.$assessment_id.'/assessment_items');



    }
}
