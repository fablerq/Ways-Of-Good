<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvancedTicket extends Model
{
    public function ticket()
    {
        return $this->hasMany('App\Models\Ticket');
    }
    
    protected $fillable = [
        'startInterval', 'endInterval', 'isMonday', 'isTuesday',
        'isWednesday', 'isThursday', 'isFriday', 'isSaturday',
        'isSunday', 'startTime', 'endTime'
    ];

    public $timestamps = false;
}
