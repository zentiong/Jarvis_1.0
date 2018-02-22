<?php
 
namespace App\Http\Controllers;

use App\Quiz;
use App\Question;
use App\User;
use App\User_Quiz;
use App\Attempt;
Use App\Skill;
use App\Section;
use App\Training;

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

        $sections = Section::where('quiz_id',$quiz_id)->get();
        $questions = array();

        foreach ($sections as $key => $section) {
            $questions_temps = $section->questions()->get();
            foreach ($questions_temps as $key => $questions_temp) {
                array_push($questions,$questions_temp);
            }
        }

          // show the view and pass the quiz to it
        return View::make('quizzes.take')
            ->with('quiz', $quiz)
            ->with('questions', $questions);
    }

    public function record(Request $request)
    {
        $user_quiz = new User_Quiz; // New Instance of User Quiz
        $quiz_id = Input::get('quiz_id'); // Get Quiz ID

        $user_quiz->user_id = Input::get('user_id'); //User Quiz Details
        $user_quiz->quiz_id = $quiz_id; //User Quiz Details

        $user_quiz->save(); // Save so that its ID can be retreived

        $user_quiz_id = $user_quiz->id; // Get ID User_Quiz ID for attempt

        $score = 0; //instantiate score

        $quiz = Quiz::find($quiz_id);

        $sections = Section::where('quiz_id',$quiz_id)->get();
        $questions = array();

        foreach ($sections as $key => $section) {
            $questions_temps = $section->questions()->get();
            foreach ($questions_temps as $key => $questions_temp) {
                array_push($questions,$questions_temp);
            }
        }

        //$temp = Input::get('temp');
        $answer_attempt = Input::get("answer_attempt");

        for ($i = 0; $i < count($questions); $i++)
        {
            // Attempt Instantiation
            $attempt = new Attempt;
            $attempt->user_quiz_id = $user_quiz_id;
            $attempt->question_id = $questions[$i]->id;

            // Error is here
            $attempt->answer_attempt = $answer_attempt[$i];

            // Get correct answer and attempt answer
            $correct_answer = $questions[$i]->answer_item;
            $attempt_answer =  $attempt->answer_attempt;

            if ($correct_answer == $attempt_answer)
            {
                $score++;
            }

            $attempt->save();
        }

        $temp = Input::get("answer_attempt");
        

        $user_quiz->score = $score;
        $user_quiz->save();

        // redirect
        Session::flash('message', 'Successfully taken quiz! Congratulations!'.' Score: '.$score
         );
        
        return Redirect::to('take_quizzes');

    }

    public function results()
    {
         // get all the assessments
        $user_quiz = User_Quiz::all();
        $users = User::all();
        $quizzes = Quiz::all();

        // load the view and pass the stuff
        return View::make('quizzes.results')
            ->with('user_quiz', $user_quiz)
            ->with('users', $users)
            ->with('quizzes', $quizzes);
    }

    public function take_quizzes()
    {
         // get all the quizzes
        $quizzes = Quiz::all();
        $user_quizzes = User_Quiz::all();

        // load the view and pass the quizzes
        return View::make('quizzes.take_quizzes')
            ->with('quizzes', $quizzes)
            ->with('user_quizzes', $user_quizzes);
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
        $user_quizzes = User_Quiz::all();
        $trainings = Training::all();

        // load the view and pass the quizzes
        return View::make('quizzes.index')
            ->with('quizzes', $quizzes)
            ->with('user_quizzes', $user_quizzes)
            ->with('trainings', $trainings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // load the create form (app/views/quizzes/create.blade.php)
        $trainings = Training::all();

        return View::make('quizzes.create')
            ->with('trainings', $trainings);
        
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
            return Redirect::to('quizzes/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $quiz = new Quiz;
            $quiz->topic = Input::get('topic');
            $quiz->training_id = Input::get('training_id');
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
        $skill = Skill::find($quiz->skill_id);

        //$questions = Question::find($quiz_id)->questions();

       //$questions = Question::find(1)->questions()->where('quiz_id', '$quiz_id')->first();

        // show the view and pass the quiz to it
        return View::make('quizzes.show')
            ->with('quiz', $quiz)
            ->with('skill', $skill);
        //->with('questions', $questions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz_id)
    {
        //get skills
        $skills = Skill::all();
         // get the quiz
        $quiz = Quiz::find($quiz_id);

        // show the edit form and pass the quiz
        return View::make('quizzes.edit')
            ->with('quiz', $quiz)
            ->with('skills', $skills);
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
            //$quiz->skill_id = Input::get('skill');
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
