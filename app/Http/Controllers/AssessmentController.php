<?php

namespace App\Http\Controllers;

use App\User;
use App\Assessment;
use App\Assessment_Item;
use App\User_Assessment;
use App\Grade;
Use App\Skill;
use App\User_Skill;
use App\Position;
use App\Job_Grade;

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
        $this->middleware('Manager', ['only' => ['make_assessments']]);
    }

    
    public function make($id)
    {
        
  // get all the assessments
        $assessment = Assessment::find($id);
        $skills = Skill::all();
        $users = User::where('supervisor_id',Auth::user()->id)->get();

        //working SQL
        //$assessment_items = Question::where('assessment_id', $id)->get();
        
        // working ELOQUENT
        $assessment_items = $assessment->assessment_items()->get();

          // show the view and pass the assessment to it
        return View::make('assessments.make')
            ->with('assessment', $assessment)
            ->with('assessment_items', $assessment_items)
            ->with('skills', $skills)
            ->with('users',$users);
    }

    public function record(Request $request)
    {
        $grades = Input::get("grades");

        $ideal_count = Input::get("ideal_count");
        $real_count = count($grades);

        $rules = array(
            'feedback' => 'required',
            'grades' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        $assessment_id = Input::get('assessment_id'); // Get Assessment ID

        // process the login
        if ($validator->fails()) {
            return Redirect::to('assessments/'.$assessment_id.'/make')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } elseif($ideal_count != $real_count){
          Session::flash('message', 'All the grades have to be filled up');
            return Redirect::to('assessments/'.$assessment_id.'/make')
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

        $user_assessment->feedback = Input::get('feedback'); 



        $user_assessment->rating = $rating/ count($assessment_items);
        $user_assessment->save();



        // Assessment -> User Skill (MAIN)

        // look for skill

        $assessment = Assessment::find($assessment_id);

        $skill_id = $assessment->skill_id;


        // instantiate

        $user_skill = User_Skill::where('user_id',Input::get('user'))
                            ->where('skill_id', $skill_id)->first();
        }


        $user = User::find(Input::get('user'));

        $user_position = $user->position; //string

        $positions = Position::all();

        foreach ($positions as $key => $position) {
            if($user_position == $position->name)
            {
                $user_position = $position; //object itself
            }
        }

        
        $user_job_grade = Job_Grade::find($user_position->job_grade); 


        if($user_skill==null) {

            $user_skill = new User_Skill;

            $user_skill->user_id = Input::get('user');
            $user_skill->skill_id = $skill_id;

            $user_skill->a_score = $user_assessment->rating; 
            $user_skill->a_max_score = 5;
        }

        // already exists
        else 
        {
            // it's saying score doesn't exist??
            $temp_score = $user_skill->a_score;
            $temp_score += $user_assessment->rating;  
            $user_skill->a_score = $temp_score;

            $temp_max_score = $user_skill->a_max_score;
            $temp_max_score += 5;
            $user_skill->a_max_score = $temp_max_score;
        }

        // Get weights

        $knowledge_based_weight = $user_job_grade->knowledge_based_weight;
        $skills_based_weight = $user_job_grade->skills_based_weight;

        //Recalculate grade

        $q_score = $user_skill->q_score;
        $q_max_score = $user_skill->q_max_score;

        if($q_max_score == 0)
        {
            $q_quotient = 0;
        }

        else {
            $q_quotient = $q_score / $q_max_score;
        }
        
        $a_score = $user_skill->a_score;
        $a_max_score = $user_skill->a_max_score;

        if($a_max_score == 0)
        {
            $a_quotient = 0;
        }
        else {
            $a_quotient = $a_score / $a_max_score;
        }
       
        $user_skill->skill_grade = ($q_quotient)*($knowledge_based_weight)+($a_quotient)*($skills_based_weight);

        $user_skill->save();

        Session::flash('message', 'Successfully made an assessment! Congratulations'
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
        $users = User::where('supervisor_id',Auth::user()->id)->get();
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
        $assessment_items = Assessment_Item::all();
        $user_assessments = User_Assessment::all();
        $skills = Skill::all();

        // load the view and pass the assessments
        return View::make('assessments.index')
            ->with('assessments', $assessments)
            ->with('user_assessments', $user_assessments)
            ->with('skills', $skills)
            ->with('assessment_items', $assessment_items);
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
            $assessment->skill_id = Input::get('skill');
            $assessment->save();

            $skills = Skill::all();
            $assessment_items = $assessment->assessment_items()->get();

            // redirect
            Session::flash('message', 'Successfully created assessment!');
            return View::make('assessment_items.index')
            ->with('assessment', $assessment)
            ->with('skills', $skills)
            ->with('assessment_items', $assessment_items);
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
            $assessment->skill_id = Input::get('skill');
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
