<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function place()
    {
        return $this->belongsTo('App\Models\Place');
    }

    protected $fillable = [
        'place_id', 'created_at', 'aboutTime',
        'endOfTicket', 'name', 'sex', 'code', 'secretCode', 
        'isCame', 'adress', 'isEat', 'isSleep', 'isMed', 'isHeat',
        'isDry', 'isWork'
    ];

    public $timestamps = false;
}
