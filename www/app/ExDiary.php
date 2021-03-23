<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExDiary extends Model
{
    protected $table = 'exdiary';

    protected $fillable = [
        'userid', 'week', 'day', 'calcdate', 'stretchingdone', 'strengtheningdone', 'notes'
    ];
}
