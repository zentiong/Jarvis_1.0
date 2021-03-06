<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

// Google

use Illuminate\Support\Facades\Session;

use App\User;
use Auth;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Socialite;
//use Auth;
use Exception;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/levels';

    // Google
    
    //use ThrottlesLogins; //nasa authenticate na daw

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            //'password' => 'required|confirmed|min:6',
        ]);
    }

    /*
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    */


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Original
    /*
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            $userModel = new User;
            $createdUser = $userModel->addNew($user);
            Auth::loginUsingId($createdUser->id);
            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect('/levels');
        }
    }
    */

    public function handleGoogleCallback()
    {
        /*
        $user_google = Socialite::driver('google')->user();
        $current_user = User::where('email',$user_google->getEmail())->first();
        Auth::loginUsingId($current_user->id);
        return redirect('/levels')->with('current_user',$current_user);
        */
            
        try {
            $user_google = Socialite::driver('google')->user();
            $current_user = User::where('email',$user_google->getEmail())->first();
            Auth::loginUsingId($current_user->id);
            return redirect('/levels');

        } catch (Exception $e) {
            Session::flash('message', 'Invalid Email');
            return redirect('/');

        }
        
    }

    // Google

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
