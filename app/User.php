<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
   
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'hiring_date', 'birth_date', 'department', 'supervisor_id', 'position', 'manager_check'
    ];
    protected $primaryKey = 'id';
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    public function quizzes() {
    return $this->hasMany("App\User_Quiz",'id');
    }
    
}
