<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Quiz extends Model
{
    //

    protected $primaryKey = 'quiz_id';

    protected $fillable = [
        'topic'
    ];

    public function questions() {
    return $this->hasMany("App\Question",'quiz_id');
  	}

  	public function users() {
    return $this->hasMany("App\User_Quiz",'id');
    }
}
