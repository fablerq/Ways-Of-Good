<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Organization extends Model
{
    
    public function ticket()
    {
        return $this->hasMany('App\Models\Ticket');
    }
    

    protected $fillable = [
        'title', 'about', 'image', 'email', 'password', 'points'
    ];

    public $timestamps = false;
}
