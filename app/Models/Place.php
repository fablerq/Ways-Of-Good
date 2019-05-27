<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Place extends Model
{
    public function icon()
    {
        return $this->belongsTo('App\Models\Icon');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function ticket()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function notification()
    {
        return $this->hasMany('App\Models\Notification');
    }

    protected $fillable = [
        'icon_id', 'user_id', 'title', 'description', 'geoData', "adress",
    ];

    public $timestamps = false;
}
