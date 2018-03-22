<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment_Item extends Model
{
    //

    protected $table = 'assessment_items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'criteria'
    ];

    public function assessment() {
    return $this->belongsTo("App\Assessment","id");
  }

}
