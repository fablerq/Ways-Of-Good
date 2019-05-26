<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    public function place()
    {
        return $this->hasMany('App\Models\Place');
    }

    protected $fillable = [
        'url',
    ];

    public $timestamps = false;
}
