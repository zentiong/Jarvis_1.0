<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    //
    protected $fillable = [
        'user_quiz_id','question_id','answer_attempt'
    ];

    public function user_quiz() {
    return $this->belongsTo("App\User_Quiz",'id');
  }
}
