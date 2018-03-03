<?php

namespace App\Http\Controllers;

use App\User;
use App\Assessment;
use App\Assessment_Item;
use App\User_Assessment;
use App\Grade;
Use App\Skill;

use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;

class AssessmentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    
    public function make($id)
    {
        
  // get all the assessments
        $assessment = Assessment::find($id);
        $users = User::where('supervisor_id',Auth::user()->id)->get();

        //working SQL
        //$assessment_items = Question::where('assessment_id', $id)->get();
        
        // working ELOQUENT
        $assessment_items = $assessment->assessment_items()->get();

          // show the view and pass the assessment to it
        return View::make('assessments.make')
            ->with('assessment', $assessment)
            ->with('assessment_items', $assessment_items)
            ->with('users',$users);
    }

    public function record(Request $request)
    {
        $grades = Input::get("grades");
        

        $rules = array(
            'feedback'       => 'required',
            'grades' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        $assessment_id = Input::get('assessment_id'); // Get Assessment ID

        // process the login
        if ($validator->fails()) {
            return Redirect::to('assessments/'.$assessment_id.'/take')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {

        $user_assessment = new User_Assessment; // New Instance of User Assessment
        $assessment_id = Input::get('assessment_id'); // Get Assessment ID

        // HERE
        $user_assessment->employee_id =  Input::get('user'); //employee

        $user_assessment->supervisor_id = Input::get('supervisor_id'); // Supervisor
        $user_assessment->assessment_id =  $assessment_id; // Assessment

        $user_assessment->save(); // Save so that its ID can be retreived

        $user_assessment_id = $user_assessment->id;

        $rating = 0; //instantiate score

        $assessment = Assessment::find($assessment_id);
        $assessment_items = $assessment->assessment_items()->get();   

        $grades = Input::get("grades");  



        for ($i = 0; $i < count($assessment_items); $i++)
        {
            // Attempt Instantiation
            $grade = new Grade;
            $grade->user_assessment_id = $user_assessment_id;
            $grade->assessment_item_id = $assessment_items[$i]->id;

            // Error is here
            $grade->grade = $grades[$i];

            $rating += $grades[$i];

            $grade->save();
        }

        $user_assessment->feedback = Input::get('feedback'); ;

        $user_assessment->rating = $rating/ count($assessment_items);
        $user_assessment->save();

        }

        // redirect
        Session::flash('message', 'Successfully made an assessment! Congratulations!'.' Rating: '.$grade
         );
        
        return Redirect::to('see_assessments');

    }

    public function make_assessments()
    {
         // get all the assessments
        $assessments = Assessment::all();
        $skills = Skill::all();

        // load the view and pass the assessments
        return View::make('assessments.make_assessments')
            ->with('assessments', $assessments)
            ->with('skills', $skills);
    }

     public function see_assessments()
    {
         // get all the assessments
        $user_assessments = User_Assessment::all();
        $assessments = Assessment::all();
        $users = User::all();
        $skills = Skill::all();

        // load the view and pass the assessments
        return View::make('assessments.see_assessments')
            ->with('user_assessments', $user_assessments)
            ->with('assessments', $assessments)
            ->with('users', $users)
            ->with('skills', $skills);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
         // get all the assessments
        $assessments = Assessment::all();
        $user_assessments = User_Assessment::all();
        $skills = Skill::all();

        // load the view and pass the assessments
        return View::make('assessments.index')
            ->with('assessments', $assessments)
            ->with('user_assessments', $user_assessments)
            ->with('skills', $skills);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // load the create form (app/views/assessments/create.blade.php)

        $skills = Skill::all();
        return View::make('assessments.create')
        ->with('skills', $skills);
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
            'topic'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('assessments/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $assessment = new Assessment;
            $assessment->topic = Input::get('topic');
            $assessment->skill_id = Input::get('skill');
            $assessment->save();

            // redirect
            Session::flash('message', 'Successfully created assessment!');
            return Redirect::to('assessments');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the assessment
        $assessment = Assessment::find($id);

        //$assessment_items = Question::find($id)->assessment_items();

       //$assessment_items = Question::find(1)->assessment_items()->where('assessment_id', '$id')->first();

        // show the view and pass the assessment to it
        return View::make('assessments.show')
            ->with('assessment', $assessment);
        //    ->with('assessment_items', $assessment_items);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // get the assessment
        $assessment = Assessment::find($id);

        // show the edit form and pass the assessment
        return View::make('assessments.edit')
            ->with('assessment', $assessment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
         // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'topic'       => 'required',            
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('assessments/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
             // store
            $assessment = Assessment::find($id);
            $assessment->topic = Input::get('topic');
            $assessment->save();

            // redirect
            Session::flash('message', 'Successfully updated assessment!');
            return Redirect::to('assessments');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assessment  $assessment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $assessment = Assessment::find($id);
        $assessment->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the assessment!');
        return Redirect::to('assessments');
    }
}
