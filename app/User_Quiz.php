<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class User_Quiz extends Model
{
    //
 	protected $table = 'user_quiz';
    

    public function user() {
  	return $this->belongsTo("App\User",'id');
  	}

  	public function quiz() {
  	return $this->belongsTo("App\Quiz",'quiz_id');
  	}

  	public function attempts() {
  	return $this->hasMany("App\Attempt");
  	}


}
