<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Ticket extends Model
{
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }

    public function advancedticket()
    {
        return $this->belongsTo('App\Models\AdvancedTicket');
    }

    public function place()
    {
        return $this->belongsTo('App\Models\Place');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }


    protected $fillable = [
        'user_id', 'organization_id', 'advancedticket_id', 'place_id', 
        'status_id', 'isEat', 'isSleep', 'isMed', 'isHeat', 
        'isDry', 'isWork', 'title', 'description', 'availableVisitors', 
        'startTime', 'endTime'
    ];

    public $timestamps = false;
}
