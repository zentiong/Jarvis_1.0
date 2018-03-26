<?php

namespace App\Http\Controllers;

use App\User;
use App\Section;
use App\Quiz;
use App\User_Quiz;
use App\User_Training;
use App\Training;
use App\Skill;
use App\Section_Attempt;
use App\Assessment;
use App\User_Assessment;
use App\User_Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;
use Auth;
use DB;

Class LevelingController extends Controller
{
	public function index()
	{
		
		
		$current_user = Auth::user(); 
		$dept = $current_user->department;
		$mg = $current_user->manager_check;	
		//$users = User::all();
		$users = User::orderBy('last_name')->paginate(3);
		$users_two = User::all();
		$trainings = Training::all();
		$quizzes = Quiz::all();
		$sections = Section::all();
		$user_quizzes = User_Quiz::all();
		$skills = Skill::all();
		$assessments = Assessment::all();
		$user_assessments = User_Assessment::all();
		$user_skills = User_Skill::all();
		$now= date('Y-m-d');
		$cwide_skills = DB::select(DB::raw("select skill_id, sum(skill_grade) as skill_grade from user_skills group by skill_id"));
        $trainings2 = Training::where('date', '<', $now)->get();
        $quiz = array();
        $result = array();

        //Training Attendance
        $counter = 0;

        foreach($trainings2 as $key => $training) {
            $quiz_temp = Quiz::where('training_id',$training->id)->first(); 
            array_push($quiz, $quiz_temp);
            $result[$counter][0] = $training->title;   
            $counter++; 
        }
       
        $counter = 0;
        
        foreach ($quiz as $key => $q) {
            $i =0;
            if (!is_null($q)){
            $user_temp = User_Quiz::where('quiz_id', $q->quiz_id)->get();
            foreach ($user_temp as $key => $value) {
              $i++;
            }
            
            }
            $result[$counter][1] = $i;
           
            $counter++;
        }

		// Trainings

        $trainings_personal = array();
        $user_trainings = User_Training::where('user_id',$current_user->id)->get();

        foreach($user_trainings as $key => $user_training) {
        	if($user_training->recommended == true)
        	{
        		$training_temp = Training::where('id',$user_training->training_id)->first(); 
				array_push($trainings_personal, $training_temp);
        	}
        }

        

        $trainings_general = array();


        foreach($trainings as $key => $training) {
            
            if(!in_array($training, $trainings_personal))
            {
            	array_push($trainings_general, $training);
            }
            
        }

        //quizzes
        $skills_quiz = array();
        $section_attempts = array();

		foreach($user_quizzes as $key => $user_quiz) {
            $section_attempts_temp = Section_Attempt::where('user_quiz_id',$user_quiz->id)->get(); 

            foreach($section_attempts_temp as $key => $temp) {
                array_push($section_attempts, $temp);
            }
        }
        foreach ($sections as $key => $section) {
            $temp = Skill::where('id', $section->skill_id)->first(); //array
            if(!in_array($temp, $skills_quiz))
            {
                array_push($skills_quiz,$temp);
            }            
        }

		
		
		if($current_user!=NULL)
		{
			if($dept=="Human Resources" OR $dept==2)
			{
				if($mg==1) // HR x Manager
				{
					return view('index_hg')
						->with('users', $users) 
						->with('users_two', $users_two)	
						->with('trainings', $trainings)
						->with('quizzes', $quizzes)
						->with('sections', $sections)
						->with('trainings_personal', $trainings_personal)
						->with('section_attempts', $section_attempts)
            			->with('user_trainings', $user_trainings)
            			->with('skills_quiz', $skills_quiz)
            			->with('trainings_general', $trainings_general)
            			->with('user_quizzes', $user_quizzes)
						->with('skills', $skills)
						->with('assessments',$assessments)
            			->with('user_assessments',$user_assessments)
						->with('user_skills',$user_skills)
						->with('now', $now)
						->with('result', $result)
						->with('mg',$mg);
				}
				else // HR
				{
					return view('index_hr')
						->with('users', $users)
						->with('trainings', $trainings)
						->with('quizzes', $quizzes)
						->with('sections', $sections)
						->with('trainings_personal', $trainings_personal)
						->with('section_attempts', $section_attempts)
            			->with('user_trainings', $user_trainings)
            			->with('skills_quiz', $skills_quiz)
            			->with('trainings_general', $trainings_general)
            			->with('user_quizzes', $user_quizzes)
            			->with('skills', $skills)
            			->with('result', $result)
            			->with('assessments',$assessments)
            			->with('user_assessments',$user_assessments)
            			->with('user_skills',$user_skills)
            			->with('now', $now)
            			->with('cwide_skills',$cwide_skills)
            			->with('mg',$mg);
				}	

			}
			else
			{
				if($mg==1) // Manager 
				{
					return view('index_mg')
						->with('users', $users)
						->with('users_two', $users_two)
						->with('quizzes', $quizzes)
						->with('sections', $sections)
						->with('section_attempts', $section_attempts)
						->with('user_quizzes', $user_quizzes)
						->with('user_assessments',$user_assessments)
						->with('trainings_personal', $trainings_personal)
						->with('trainings_general', $trainings_general)
						->with('user_trainings', $user_trainings)
						->with('trainings', $trainings)
						->with('skills', $skills)
						->with('user_skills',$user_skills)
						->with('now', $now)
						->with('mg',$mg);
				}
				else // Normal
				{
					return view('index_nr')
						->with('users', $users)
						->with('quizzes', $quizzes)
						->with('trainings_personal', $trainings_personal)
						->with('section_attempts', $section_attempts)
            			->with('user_trainings', $user_trainings)
            			->with('trainings_general', $trainings_general)
            			->with('trainings',$trainings)
            			->with('user_quizzes', $user_quizzes)
            			->with('user_assessments',$user_assessments)
            			->with('skills', $skills)
            			->with('user_skills',$user_skills)
            			->with('now', $now)
            			->with('mg',$mg);
				}
			}
		}
	}
}