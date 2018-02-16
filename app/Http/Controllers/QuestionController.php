<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Question;
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

        //working SQL
        //$questions = Question::where('quiz_id', $quiz_id)->get();
        
        // working ELOQUENT
        $questions = $quiz->questions()->get();

          // show the view and pass the quiz to it
        return View::make('questions.index')
            ->with('quiz', $quiz)
            ->with('questions', $questions);
    }

    

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quiz_id)
    {
        return View::make('questions.create')
        ->with('quiz_id', $quiz_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $quiz_id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'question_item'       => 'required',
            'answer_item'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('quizzes/'.$quiz_id.'/questions/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $question = new Question;
            $question->question_item = Input::get('question_item');
            $question->answer_item = Input::get('answer_item');
            $question->quiz_id = $quiz_id;
            $question->save();

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
