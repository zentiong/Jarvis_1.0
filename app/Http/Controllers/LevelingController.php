<?php

namespace App\Http\Controllers;

use App\User;
use App\TrainingSession;
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
		$training_sessions = TrainingSession::all();

		
		
		if($current_user!=NULL)
		{
			if($dept=="Human Resources" OR $dept==2)
			{
				if($mg==1)
				{
					return view('index_hg')
						->with('users', $users)
						->with('training_sessions', $training_sessions);
				}
				else
				{
					return view('index_hr')
						->with('users', $users)
						->with('training_sessions', $training_sessions);
				}	

			}
			else
			{
				if($mg==1)
				{
					return view('index_mg')
						->with('users', $users);
				}
				else
				{
					return view('welcome');
				}
				
			}
		}
	}
}