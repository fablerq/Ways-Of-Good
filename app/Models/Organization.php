<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Organization extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function ticket()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    protected $fillable = [
        'title', 'about'
    ];

    public $timestamps = false;
}
