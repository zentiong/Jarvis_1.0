<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Question;
use App\Section;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index($quiz_id)
    {
        // get all the quizzes
        $quiz = Quiz::find($quiz_id);
        $sections = Section::where('quiz_id',$quiz_id)->get();
        $questions = array();

        foreach ($sections as $key => $section) {
            $questions_temps = $section->questions()->get();
            
            foreach ($questions_temps as $key => $questions_temp) {
                array_push($questions,$questions_temp);
            }
        }

        $skills = Skill::all();

        // show the view and pass the quiz to it
        return View::make('questions.index')
            ->with('quiz', $quiz)
            ->with('questions', $questions)
            ->with('skills', $skills)
            ->with('sections',$sections);
    }

     public function add_section($quiz_id)
    {
        $skills = Skill::all();
        $sections = Section::where('quiz_id',$quiz_id)->get();

        return View::make('questions.add_section')
        ->with('quiz_id', $quiz_id)
        ->with('skills',$skills)
        ->with('sections',$sections);
    }

     public function store_section(Request $request, $quiz_id)
    {
        $section = New Section;

        $section->quiz_id = $quiz_id;
        $section->skill_id = Input::get('skill_id');

        $section->save();

        // redirect
        Session::flash('message', 'Successfully made a Section!'
         );
        
        return Redirect::to('quizzes/'.$quiz_id.'/questions');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create($section_id)
    {
        return View::make('questions.create')
        ->with('section_id', $section_id);
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
            'question_item'       => 'required',
            'answer_item'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        $sections = Section::all();

        $quiz_id = Input::get('quiz_id');

        // process the login
        if ($validator->fails()) {
            return Redirect::to('quizzes/'.$quiz_id.'/questions/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            foreach ($sections as $key => $section) {
                if($section->id == Input::get('section_id'))
                {
                    $question = new Question;
                    $question->question_item = Input::get('question_item');

                    switch (Input::get('answer_item')) {
                        case 'choice_1':
                            $question->answer_item = Input::get('choice_1');
                            break;
                        case 'choice_2':
                            $question->answer_item = Input::get('choice_2');
                            break;
                        case 'choice_3':
                            $question->answer_item = Input::get('choice_3');
                            break;
                        case 'choice_4':
                            $question->answer_item = Input::get('choice_4');
                            break;
                    }

                    $question->answer_item = Input::get('answer_item');
                    $question->section_id =Input::get('section_id');
                    $question->save();
                }
            }

            // redirect
            Session::flash('message', 'Successfully created question!');
            return Redirect::to('quizzes/'.$quiz_id.'/questions');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($quiz_id, $id)
    {
        //
        
    	$quiz = Quiz::find($quiz_id);
    	$question = Question::find($id);

    	 return View::make('questions.show')
            ->with('quiz', $quiz)
            ->with('question', $question);
            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz_id, $id)
    {
        
          // get the quiz
    	$quiz = Quiz::find($quiz_id);
        $question = Question::find($id);

        // show the edit form and pass the question
        return View::make('questions.edit')
            ->with('question', $question)
            ->with('quiz', $quiz);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update($quiz_id, $id)
    {
        $rules = array(
            'question_item'       => 'required',
            'answer_item'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('quizzes/'.$quiz_id.'/questions/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $question = Question::find($id);
            $question->question_item = Input::get('question_item');
            $question->answer_item = Input::get('answer_item');
            $question->section_id =Input::get('section_id');
            $question->save();

            // redirect
            Session::flash('message', 'Successfully edited question!');
            return Redirect::to('quizzes/'.$quiz_id.'/questions');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz_id, $id)
    {

    	// delete (working)
        $question = Question::find($id);
        $question->delete();

        // redirect (working)
        Session::flash('message', 'Successfully deleted the question!');
        return Redirect::to('quizzes/'.$quiz_id.'/questions');



    }
}
