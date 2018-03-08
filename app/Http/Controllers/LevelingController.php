<?php

namespace App\Http\Controllers;

use App\User;
use App\Training;
use App\Quiz;
use App\Section;
use App\User_Training;
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
						->with('sections', $sections);
				}
				else // Normal
				{
					return view('index_nr')
						->with('users', $users)
						->with('quizzes', $quizzes)
						->with('sections', $sections)
						->with('trainings_personal', $trainings_personal)
            			->with('user_trainings', $user_trainings)
            			->with('trainings_general', $trainings_general);
				}
				
			}
		}
	}
}