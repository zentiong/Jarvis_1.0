<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;

class QuizController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    
    public function take($quiz_id)
    {
        
  // get all the quizzes
        $quiz = Quiz::find($quiz_id);

        //working SQL
        //$questions = Question::where('quiz_id', $quiz_id)->get();
        
        // working ELOQUENT
        $questions = $quiz->questions()->get();

          // show the view and pass the quiz to it
        return View::make('quizzes.take')
            ->with('quiz', $quiz)
            ->with('questions', $questions);
    }

    public function create()
    {
        // load the create form (app/views/quizzes/create.blade.php)
        return View::make('quizzes.create');
    }

    public function store($quiz_id, Request $request)
    {
        $user_quiz = new User_Quiz;

        $user_quiz->user_id = Input::get('user_id');
        $user_quiz->quiz_id = $quiz_id;

        $score = 0;
        $quiz = Quiz::find($quiz_id);
        $questions = $quiz->questions()->get();

        for ($i = 0; $i < count($questions); $i++)
        {
            $correct_answer = $questions[$i]->answer_item;
            $user_answer = Input::get("answer_attempt[$i]");
            if ($correct_answer == $user_answer)
            {
                $score++;
            }
        }

        $user_quiz->score = $score;
        $user_quiz->save();

        // redirect
        Session::flash('message', 'Successfully created quiz!');
        return Redirect::to('quizzes');

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // get all the quizzes
        $quizzes = Quiz::all();

        // load the view and pass the quizzes
        return View::make('quizzes.index')
            ->with('quizzes', $quizzes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function record(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'topic'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('quizzes/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $quiz = new Quiz;
            $quiz->topic = Input::get('topic');
            $quiz->save();

            // redirect
            Session::flash('message', 'Successfully created quiz!');
            return Redirect::to('quizzes');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show($quiz_id)
    {
        // get the quiz
        $quiz = Quiz::find($quiz_id);

        //$questions = Question::find($quiz_id)->questions();

       //$questions = Question::find(1)->questions()->where('quiz_id', '$quiz_id')->first();

        // show the view and pass the quiz to it
        return View::make('quizzes.show')
            ->with('quiz', $quiz);
        //    ->with('questions', $questions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz_id)
    {
         // get the quiz
        $quiz = Quiz::find($quiz_id);

        // show the edit form and pass the quiz
        return View::make('quizzes.edit')
            ->with('quiz', $quiz);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update($quiz_id)
    {
         // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'topic'       => 'required',            
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('quizzes/' . $quiz_id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
             // store
            $quiz = Quiz::find($quiz_id);
            $quiz->topic = Input::get('topic');
            $quiz->save();

            // redirect
            Session::flash('message', 'Successfully updated quiz!');
            return Redirect::to('quizzes');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz_id)
    {
        // delete
        $quiz = Quiz::find($quiz_id);
        $quiz->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the quiz!');
        return Redirect::to('quizzes');
    }
}
