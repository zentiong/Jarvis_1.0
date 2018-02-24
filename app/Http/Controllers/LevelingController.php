<?php

namespace App\Http\Controllers;

use App\User;
use App\Training;
use App\Quiz;
use App\Section;
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

		
		
		if($current_user!=NULL)
		{
			if($dept=="Human Resources" OR $dept==2)
			{
				if($mg==1)
				{
					return view('index_hg')
						->with('users', $users) 	
						->with('trainings', $trainings)
						->with('quizzes', $quizzes)
						->with('sections', $sections);
				}
				else
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
				if($mg==1)
				{
					return view('index_mg')
						->with('users', $users)
						->with('quizzes', $quizzes)
						->with('sections', $sections);
				}
				else
				{
					return view('index_nr')
						->with('users', $users)
						->with('quizzes', $quizzes)
						->with('sections', $sections);
				}
				
			}
		}
	}
}