<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //

    protected $fillable = [
        'user_assessment_id','question_id','answer_attempt'
    ];

    public function user_assessment() {
    return $this->belongsTo("App\User_Assessment",'id');
  }
}
