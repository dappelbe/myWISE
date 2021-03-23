<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExPlan extends Model
{

    protected $table = 'explan';

    protected $fillable = [
        'userid', 'repeatnum', 'ltgoal', 'smartgoal', 'exwhere', 'exwhen',
        'exalternative', 'physioname', 'previousachieved',
    ];
}
