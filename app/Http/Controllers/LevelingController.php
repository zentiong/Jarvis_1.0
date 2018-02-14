<?php

namespace App\Http\Controllers;

use App\User;
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

		
		
		if($current_user!=NULL)
		{
			if($dept=="Human Resources")
			{
				if($mg==1)
				{
					return view('index_hg');
				}
				else
				{
					return view('index_hr');
				}

			}
			else
			{
				if($mg==1)
				{
					return view('index_mg');
				}
				else
				{
					return view('welcome');
				}
				
			}
		}
	}
}