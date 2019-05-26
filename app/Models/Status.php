<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function ticket()
    {
        return $this->hasMany('App\Models\Ticket');
    }
    
    protected $fillable = [
        'title',
    ];

    public $timestamps = false;
}
