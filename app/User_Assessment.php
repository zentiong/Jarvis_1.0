<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Assessment extends Model
{
    //

    protected $table = 'user_assessments';

    public function user() {
  	return $this->belongsTo("App\User",'id');
  	}

  	public function assessment() {
  	return $this->belongsTo("App\Assessment",'id');
  	}

  	public function grades() {
  	return $this->hasMany("App\Grade");
  	}
}
