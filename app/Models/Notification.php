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
        'place_id', 'name', 'age', 'code', 'isCame', 'adress'
    ];

    public $timestamps = false;
}
