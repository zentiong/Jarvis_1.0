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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;
use Auth;

Class LevelingController extends Controller
{
	public function index()
	{
		
		
		$current_user = Auth::user(); 
		$dept = $current_user->department;
		$mg = $current_user->manager_check;	
		$users = User::all();
		$trainings = Training::all();
		$quizzes = Quiz::all();
		$sections = Section::all();
		$user_quizzes = User_Quiz::all();
		$skills = Skill::all();
		


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
						->with('trainings', $trainings)
						->with('quizzes', $quizzes)
						->with('sections', $sections);
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
            			->with('sections', $sections);
				}	

			}
			else
			{
				if($mg==1) // Manager 
				{
					return view('index_mg')
						->with('users', $users)
						->with('quizzes', $quizzes)
						->with('sections', $sections)
						->with('section_attempts', $section_attempts)
						->with('user_quizzes', $user_quizzes);
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
            			->with('user_quizzes', $user_quizzes);
				}
				
			}
		}
	}
}